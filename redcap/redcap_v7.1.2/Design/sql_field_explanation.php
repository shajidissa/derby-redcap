<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

require_once dirname(dirname(__FILE__)) . '/Config/init_project.php';

// Display text
$title = 'REDCap\'s "sql" field type for dynamically querying data';
$content = <<<EOT
<div class="wikipage searchable">
<h4 style="font-size:14px;margin-top:0;">The "sql" field type</h4>
<p style="">
The "sql" field type allows one to populate a drop-down list on a REDCap project's data entry form or survey by providing an SQL query ("select" queries only)
in the Online Designer for a field or in the Select Choices column of the Data Dictionary. Using an "sql" field can allow you to simulate a one-to-many
relationship from one REDCap project to another, or it can simply allow you to have a drop-down field populated with a dynamic list of choices.
Any query can be used for an "sql" field so long as the database table being queried exists in the same MySQL database as the REDCap tables.
Also, ONLY REDCap super users may add or modify "sql" field types either via the Data Dictionary or the Online Designer. You must know how to
construct an SQL query in order to use this field type. <b>NOTE:</b> The only field in a project that cannot be set as an "sql" field is
the record ID field (i.e., the first field in the project).
</p>
<p>
The advantage of the "sql" field type is that it allows you to populate a drop-down from a dynamic source (i.e. a database table) rather than a static source (i.e. the choices provided in the Select Choices metadata column). When constructing the query itself, only 1 or 2 fields may be used in the query (which must be a "select" query). If only one field exists in the SQL statement, the values retrieved from the query will serve as both the values AND the displayed text for the drop-down that is populated. If two fields are queried, the first field serves as the unseen values of the drop-down list while the second field gets displayed as the visible text inside the drop-down as seen by the user.
</p>
<p>
NOTE: If you are using an "sql" field to query REDCap's data table (redcap_data), remember that the table is an EAV model table, so it is not a flat table like an Excel spreadsheet, as is the data exported out of REDCap in CSV format. So it may be necessary to use sub-queries or multiple joins in order to effectively provide limiters on your query to return the exact data you want.
</p>


<h4 style="font-size:14px;">Example</h4>
<p>
Here is an example of how one might query the redcap_data table by using a sub-query inside the query to work as a filter so that it returns the record name and institution name for *only* the records that have a 'consortium_status' value of '1'.
</p>
<pre style="padding:3px;border:1px solid #ddd;background-color:#f5f5f5;">select record, value from redcap_data where project_id = 390 and field_name = 'institution'
and record in (select distinct record from redcap_data where project_id = 390
and field_name = 'consortium_status' and value = '1') order by value
</pre><p>
But the query above could also be constructed instead using a JOIN rather than a sub-query.
</p>
<pre style="padding:3px;border:1px solid #ddd;background-color:#f5f5f5;">select a.record, a.value from redcap_data a left join redcap_data b
on a.project_id = b.project_id and a.record = b.record and a.event_id = b.event_id
where a.project_id = 390 and a.field_name = 'institution'
and b.field_name = 'consortium_status' and b.value = '1' order by a.value
</pre><p>
If the redcap_data table were a "flat" formatted table (or if you are querying any kind of flat table), the query above might look something like the one below.
</p>
<pre style="padding:3px;border:1px solid #ddd;background-color:#f5f5f5;">select auto_num, institution from FLAT_TABLE where project_id = 390
and consortium_status != '4' order by auto_num
</pre>



<h4 style="font-size:14px;margin-top:20px;">Complex Example</h4>
<p>
Here is an example where we are bringing in a bunch of patient details into a dropdown in another project.  It uses both CONCAT and CONCAT_WS.  CONCAT_WS is nice because it will leave out any null parameters whereas CONCAT will return NULL if any part of the expression is NULL.  So, if MRN is not defined for a record, it will not appear in the list.
</p>
<pre style="padding:3px;border:1px solid #ddd;background-color:#f5f5f5;">SELECT a.record,
   CONCAT_WS(' | ',
      CONCAT('R: ', max(if(a.field_name = 'record_id', a.value, NULL))),
      CONCAT('MRN: ', max(if(a.field_name = 'mrn', a.value, NULL))),
      CONCAT_WS(', ',
         max(if(a.field_name = 'last_name', a.value, NULL)),
         max(if(a.field_name = 'first_name', a.value, NULL))
      ),
      CONCAT('DOB: ', max(if(a.field_name = 'dob', a.value, NULL))),
      CONCAT('TX: ', max(if(a.field_name = 'tx', a.value, NULL))),
      CONCAT('DATE: ', max(if(a.field_name = 'date_tx', a.value, NULL))),
      CONCAT('ID: ', max(if(a.field_name = 'study_id', a.value, NULL)))
   ) as value
FROM redcap_data a
WHERE a.project_id=1360
   AND a.event_id=5854
GROUP BY a.record
ORDER BY a.record;
</pre>

</div>
EOT;

// Output text
print json_encode(array('title'=>$title, 'content'=>$content));