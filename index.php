<?php

$host="localhost";
$username="root";
$password="";
$dbname="pdo";

//Create DSN
$dsn="mysql:host=".$host.";dbname=".$dbname;

//Create PDO instance
$pdo=new PDO($dsn,$username,$password);

//PDO query
$stmt=$pdo->query("Select * from mytable");
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

//Through Array
/*
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
	echo $row['name']."<br>";
}
*/

//Through Object	
/*while($row=$stmt->fetch(PDO::FETCH_OBJ)){
	echo $row->name."<br>";
}


while($row=$stmt->fetch()){
	echo $row['name']."<br>";
}*/

//Prepared Statements(Prepare and Execute)

//unsafe way
//$sql="Select * from mytable where project='".$project."'";

//Two types:Positional parameters and named parameters

//Positional parameters

$project="TPD";
$sql="Select * from mytable where project=?";
$stmt=$pdo->prepare($sql);
$stmt->execute([$project]);
$output=$stmt->fetchAll(PDO::FETCH_ASSOC);

//With while loop
/*while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
	echo $row['name']."<br>";
}*/

//With for loop
foreach($output as $outputs)
{
	echo $outputs['name']."<br>";
}


//Named parameter.Chronology should be maintained

$project="TPD";
$name="S%";
$sql="Select * from mytable where project=:project and name like :name";
$stmt=$pdo->prepare($sql);
$stmt->execute(["project"=>$project,"name"=>$name]);
$output=$stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($output as $outputs)
{
	echo $outputs['name']."<br>";
}

//Fetch single post.Use fetch instead of fetchAll
$id=3;
$sql="Select * from mytable where id=:id";
$stmt=$pdo->prepare($sql);
$stmt->execute(["id"=>$id]);
$output=$stmt->fetch(PDO::FETCH_OBJ);
				
echo "Single post value=".$output->name."<br>";	

//RowCount
$id=3;
$sql="Select * from mytable where id=:id";
$stmt=$pdo->prepare($sql);
$stmt->execute(["id"=>$id]);
$output=$stmt->rowCount();
echo "Num rows are".$output."<br>";

//Insert Data
/*$name="Stuti";
$designation="Software Developer";
$location="Jharkhand";
$project="EDC";
$sql="Insert into mytable (name,designation,location,Project) values(?,?,?,?)";
$stmt=$pdo->prepare($sql);
$stmt->execute([$name,$designation,$location,$project]);

echo "Data inserted";*/

//Update Data

/*$location="India";
$sql="Update mytable set location=? where id=1";
$stmt=$pdo->prepare($sql);
$stmt->execute([$location]);

echo "Data updated";*/

//Delete Data

/*$project="EDC";
$sql="Delete from mytable where project=?";
$stmt=$pdo->prepare($sql);
$stmt->execute([$project]);
echo "Data deleted";*/

//For limit data we need to set this
//$pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, false);
?>
	