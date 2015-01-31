EPCMS Lite Version
=========

This version is a lite copy of version. This version is not supported and users are free to use it.

##### How to start
- Upload files to your server or local host
- Configure the connection Details in includes/config.php:
```
$configDatabase['server'] = 'localhost'; // Server 
$configDatabase['username'] = 'root'; // Username
$configDatabase['password'] = ''; // Password
$configDatabase['dbname'] = ''; Database Name
$configDatabase['prefix'] = 'epcms_'; Prefix if applicable 
```

##### Methods
```
$script->safeinput('any input here'); ## To secure any user entries
$script->reading_multi_languages('JSON Object', 'Language ID'); ## To read JSON object that contain several languages
$script->is_duplicated($input, $field, $table, $exclude = ''); ## To check for any duplicated records such as usernames and emails
$script->generate_random_string(INT Length); ## To generate random code;
$script->array_sort_bycolumn(array, column, ASC/DESC); ## To sort an array by specific column
$script->api_fetch('URL'); ## Reading external link (CURL)
$script->db->query('Standard Query Language'); ## to run MySQL query
$script->db->fetch_fields(); ## To list table's fields 
$script->db->fetch_array(); ## To fetch data from database
$script->db->num_rows(); ## To count query results
$script->db->insert_id(); ## Last inserted ID (Primary Key)
$script->db->insert('Table Name', array(Fields), array(values));
$script->db->update('Table Name', array(Fields), array(values), ' primary_key = #key#');
$script->db->query_limit('Total of results', 'current page number', 'records per page'); ## To get limits of each page
$script->db->pagination_number('Total of results', 'records per page'); ## To get number of pages per query
$script->detect->isMobile(); ## To check if browser is using mobile device
$script->detect->isTablet(); ## To check if browser is using a tablet
```
##### Notes
- This is  a beta version
- Script can read any file in the root directory in the following way: http://[domain]/epcms/[filename]
