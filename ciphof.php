<?php Header('Content-type: text/xml');
$servername = "localhost"; //the address to the server hosting freepbx mysql database
$username = "freepbxuser"; //username to connect with (freepbxuser is default)
$password = "password"; //and the password to be used, it can be found i /etc/freepbx.conf
$dbname = "asterisk"; //database name holding the users and extensions, asterisk is the default database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, extension FROM users ORDER BY name";
$result = $conn->query($sql);

echo "<CiscoIPPhoneDirectory>
<Title>Phone Directory</Title>
<Prompt>People reachable via VoIP</Prompt>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<DirectoryEntry>
                        <Name>" . $row["name"]. "</Name>
                        <Telephone>" . $row["extension"]. "</Telephone>
                </DirectoryEntry>";
    }
} else {
    echo "0 results";
}
$conn->close();
echo "</CiscoIPPhoneDirectory>";
?>

