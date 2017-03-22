# docker_redcap_fresh

Use this Docker image once you have succesfully upgraded Redcap using **docker_redcap_upgrade**

Amend the file **database.php**, add the following information.

<em>$hostname 	= 'XXXXXXXXXXXXXXX';</em><br>
<em>$db 		    = 'XXXXXXXXXXXXXXX';</em><br>
<em>$username 	= 'XXXXXXXXXXXXXXX';</em><br>
<em>$password 	= 'XXXXXXXXXXXXXXX';</em><br>

**hostname** is the format  xxxxxxx.xuhl-tr.nhs.uk

Change the Dockerfile if a newer version of Redcap needs to be deployed. Also add the correct redcap install zip to the directory.

To **build** the image :

  * sudo docker build -t lcbruit/redcap_fresh:v6.17.0 .

Ensure that the **version number** matches the actual redcap version you are upgrading to. 

To **run** the docker container :
 
  * sudo docker run -itd -p 82:80 -v /share:/share/ lcbruit/redcap_fresh:v6.17.0
  
Ensure that the **version number** matches the actual redcap version you are upgrading to.

To **connect** to container :

  * sudo docker ps -a
  * sudo docker exec -i -t [CONTAINER ID] /bin/bash
  
Test Redcap :

  * http://XXXXXXXXXXXXXX.xuhl-tr.nhs.uk/redcap

Ensure that the correct version number is displayed.
