<?php
 ob_start();
 include_once '../PHP/all.inc.php';

 include_once '../vendor/fpdf184/fpdf.php';




 



if (isset($_POST['printall'])) {

    $select = "SELECT * FROM counseling_cases LEFT JOIN counseling_services ON counseling_cases.counselingApproach = counseling_services.service_id INNER JOIN student ON counseling_cases.student_id = student.student_id";

    // $select = "select * from student";

    $result = $db->query($select);



    class PDF extends FPDF

    {

    // Page header

    function Header()

    {

        // Logo

        $this->Image('logo.png',15,6,30);

        // Arial bold 15

        $this->SetFont('Arial','B',15);

        // Move to the right

        $this->Cell(80);

        // Title

        $this->Cell(30,10,'Guidance Counseling Management System',0,0,'C');

        $this->Ln(7);

        $this->SetFont('Arial','',10);

        $this->Cell(80);

        $this->Cell(30,10,'Ilocos Sur Polythenic State College',0,0,'C');

        // Line break

        $this->Ln(40);

    }

    

    // Page footer

    function Footer()

    {

        // Position at 1.5 cm from bottom

        $this->SetY(-15);

        // Arial italic 8

        $this->SetFont('Arial','I',8);

        // Page number

        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

    }

    }

    



    // Instanciation of inherited class

    $pdf = new PDF();

    $pdf->AliasNbPages();

    $pdf->AddPage();

  

    $pdf->SetFont('Arial', '',18);

    $pdf->Cell(60);

    $pdf->Cell(80,10,'Counseling Records',0);

    $pdf->Ln();

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(85,6,'Student ID',1);

    $pdf->Cell(45,6,'Name',1);

    $pdf->Cell(45,6,'Date & Time',1);

    $pdf->Ln();

    while($row = $result->fetch_object()){

        $id = $row->student_id;

        $name = $row->firstname . ' ' . $row->lastname;

        // strip_tags($text, '<p><a>');

        // $date = str_replace(['<p>', '</p>'], '', $row->backgroundCase);

        $date = $row->datetime_made;



    $pdf->Cell(85,10,$id,1);

    $pdf->Cell(45,10,$name,1);

    $pdf->Cell(45,10,$date,1);

    $pdf->Ln();

    }

    $pdf->Output();

}





 if (isset($_POST['print'])) {

    $case_id =  $_POST['case_id'];

    

    $select = "SELECT * FROM counseling_cases LEFT JOIN counseling_services ON counseling_cases.counselingApproach = counseling_services.service_id INNER JOIN student ON counseling_cases.student_id = student.student_id WHERE case_id = '$case_id'";

    // $select = "select * from student";

    $result = $db->query($select);



    class PDF extends FPDF

    {

    // Page header

    function Header()

    {

        // Logo

        $this->Image('logo.png',15,6,30);

        // Arial bold 15

        $this->SetFont('Arial','B',15);

        // Move to the right

        $this->Cell(80);

        // Title

        $this->Cell(30,10,'Guidance Counseling Management System',0,0,'C');

        $this->Ln(7);

        $this->SetFont('Arial','',10);

        $this->Cell(80);

        $this->Cell(30,10,'Ilocos Sur Polythenic State College',0,0,'C');

        // Line break

        $this->Ln(20);



    }

    

    // Page footer

    function Footer()

    {

        // Position at 1.5 cm from bottom

        $this->SetY(-15);

        // Arial italic 8

        $this->SetFont('Arial','I',8);

        // Page number

        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

    }

    }

    



    // Instanciation of inherited class

    $pdf = new PDF();

    $pdf->AliasNbPages();

    $pdf->AddPage();

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(80);

    $pdf->Cell(85,10,'Counseling Information',0);

    $pdf->Ln();

    $row = $result->fetch_object();

        $id = $row->student_id;

        $name = $row->firstname . ' ' . $row->lastname;

       

        $bc = str_replace(['<p>', '</p>'], '', $row->backgroundCase);

        $cg = str_replace(['<p>', '</p>'], '', $row->counselingGoal);

        $sn = str_replace(['<p>', '</p>'], '', $row->service_name);

        $c = str_replace(['<p>', '</p>'], '', $row->comment);

        $r = str_replace(['<p>', '</p>'], '', $row->recommendation);

        $date = $row->datetime_made;

    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Student ID: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,$id,0);

    $pdf->Ln();

    

    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Student Name: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(45,10,$name,0);

    $pdf->Ln();



    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Date: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(45,10,$date,0);

    $pdf->Ln();



    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Case Background: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Ln();

    $pdf->MultiCell(175,8,$bc,0,'J');

    $pdf->Ln();



    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Counseling Goals: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Ln();

    $pdf->MultiCell(175,8,$cg,0,'J');

    $pdf->Ln();



    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Approach: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(45,10,$sn,0);

    $pdf->Ln();



    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Comment: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Ln();

    $pdf->MultiCell(175,8,$c,0);

    $pdf->Ln();



    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Recommendation: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Ln();

    $pdf->MultiCell(175,8,$r,0);

    $pdf->Ln();

    

    $pdf->Output();

 }

if (isset($_POST['print_mess'])) {

    $id =  $_POST['student_id'];

    

    $select = "SELECT * FROM `messages` INNER JOIN student ON messages.sender = student.id WHERE messages.sender = '$id'  ORDER BY datetime DESC";

    // $select = "select * from student";

    $result = $db->query($select);



    class PDF extends FPDF

    {

    // Page header

    function Header()

    {

        // Logo

        $this->Image('logo.png',15,6,30);

        // Arial bold 15

        $this->SetFont('Arial','B',15);

        // Move to the right

        $this->Cell(80);

        // Title

        $this->Cell(30,10,'Guidance Counseling Management System',0,0,'C');

        $this->Ln(7);

        $this->SetFont('Arial','',10);

        $this->Cell(80);

        $this->Cell(30,10,'Ilocos Sur Polythenic State College',0,0,'C');

        // Line break

        $this->Ln(20);



    }

    

    // Page footer

    function Footer()

    {

        // Position at 1.5 cm from bottom

        $this->SetY(-15);

        // Arial italic 8

        $this->SetFont('Arial','I',8);

        // Page number

        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

    }

    }

    



    // Instanciation of inherited class

    $pdf = new PDF();

    $pdf->AliasNbPages();

    $pdf->AddPage();

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(80);

    $pdf->Cell(85,10,'Help Desk Information',0);

    $pdf->Ln();

    $res = $result->fetch_object();

    $name = $res->firstname . ' ' . $res->lastname;
    $email = $res->email;
    $contact  = $res->contact_number;
    $address = $res->address;
    $year = $res->course . ' '. $res->year .' '. $res->section;


    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Student ID: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,$res->student_id,0);

    $pdf->Ln();


    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Student Name: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(45,10,$name,0);

    $pdf->Ln();
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Year & Section: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,$year,0);

    $pdf->Ln();
    
   $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Email: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,$email,0);

    $pdf->Ln();
    
   $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Contact Number: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,$contact,0);

    $pdf->Ln();
    
   $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Address: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,$address,0);

    $pdf->Ln(30);

    while($row = $result->fetch_object()) {

        $id = $row->student_id;

        $name = $row->firstname . ' ' . $row->lastname;


        $date = $row->datetime;
        $msg = $row->message;

  



    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Date: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(45,10,$date,0);

    $pdf->Ln();



 
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Message: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Ln();

    $pdf->MultiCell(175,8,$msg,0);

    $pdf->Ln();

    }

    $pdf->Output();
   
}


if (isset($_POST['print_student'])) {

    $id =  $_POST['student_id'];

    

    $select = "SELECT * FROM `student` WHERE id = '$id'";

    // $select = "select * from student";

    $result = $db->query($select);



    class PDF extends FPDF

    {

    // Page header

    function Header()

    {

        // Logo

        $this->Image('logo.png',15,6,30);

        // Arial bold 15

        $this->SetFont('Arial','B',15);

        // Move to the right

        $this->Cell(80);

        // Title

        $this->Cell(30,10,'Guidance Counseling Management System',0,0,'C');

        $this->Ln(7);

        $this->SetFont('Arial','',10);

        $this->Cell(80);

        $this->Cell(30,10,'Ilocos Sur Polythenic State College',0,0,'C');

        // Line break

        $this->Ln(20);



    }

    

    // Page footer

    function Footer()

    {

        // Position at 1.5 cm from bottom

        // $this->SetY(-15);

        // Arial italic 8

        // $this->SetFont('Arial','I',8);

        // Page number

        // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

    }

    }

    



    // Instanciation of inherited class

    $pdf = new PDF();

    $pdf->AliasNbPages();

    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B',14);

    $pdf->Cell(80);

    $pdf->Cell(85,10,'Student Information',0);

    $pdf->Ln(10);

    $res = $result->fetch_object();

    $name = $res->firstname . ' ' . $res->lastname;
    $email = $res->email;
    $contact  = $res->contact_number;
    $address = $res->address;
    $year = $res->course . ' '. $res->year .' '. $res->section;


    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Student ID: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,$res->student_id,0);

    $pdf->Ln();


    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Student Name: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,$name,0);

    
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Year & Section: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,$year,0);

    $pdf->Ln();
    
   $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Email: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,$email,0);
    
   $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Contact Number: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,$contact,0);

    $pdf->Ln();
    
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Address: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,$address,0);
    
        $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Civil Status: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,$res->civilstatus,0);

    $pdf->Ln();
    
     $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Age: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,$res->age,0);
    
      $pdf->SetFont('Arial', 'B',12);
    
     $pdf->Cell(40,10,'Citizenship: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,$res->citizenship,0);

    $pdf->Ln();
    
     $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Date of Birth: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,date("F j, Y", strtotime($res->birthdate)),0);
    
         $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,'Place of Birth: ',0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(55,10,($res->placeofbirth),0);

    $pdf->Ln();
    
     $pdf->Cell(80);
     
      $pdf->SetFont('Arial', 'B',14);
     $pdf->Cell(60,10,'Family Background',0);
    $pdf->Ln(10);
    
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,"Father's Name: ",0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(60,10,$res->f_name,0);
    
       $pdf->SetFont('Arial', 'B',12);
     
    $pdf->Cell(40,10,"Mother's Name: ",0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(60,10,$res->m_name,0);

    $pdf->Ln();

 
    
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,"Birth Date: ",0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(60,10,date("F j, Y", strtotime($res->f_birthdate)),0);
    
      $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,"Birth Date: ",0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(60,10,date("F j, Y", strtotime($res->m_birthdate)),0);

    $pdf->Ln();

 
    
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,"Address: ",0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(60,10,$res->f_address,0);
    
        $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,"Address: ",0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(60,10,$res->m_address,0);


    $pdf->Ln();

 
    
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,"Contact No.: ",0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(60,10,$res->f_contact_number,0);
    
        
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(40,10,"Contact No.: ",0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(60,10,$res->m_contact_number,0);

    $pdf->Ln();

    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(100,10,"Highest Education Attained: ",0);

    $pdf->SetFont('Arial', '',12);

   
    
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(100,10,"Highest Education Attained: ",0);

    $pdf->SetFont('Arial', '',12);

  

    $pdf->Ln();
     $pdf->Cell(90,10,$res->f_education,0);
       $pdf->Cell(90,10,$res->m_education,0);
    $pdf->Ln();
    
          $pdf->SetFont('Arial', 'B',14);
       $pdf->Cell(80);
     $pdf->Cell(85,10,'Educational Background',0);
    $pdf->Ln(10);
    
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(60,10,"Elementary School: ",0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(60,10,$res->elem_school,0);
    
    $pdf->Ln();

    
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(60,10,"Elementary Address: ",0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(60,10,$res->elem_address,0);
    
    $pdf->Ln();

    
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(60,10,"Year Graduated: ",0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(60,10,$res->elem_grad,0);
    
    $pdf->Ln();


 
    
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(60,10,"Elementary Award/s: ",0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(60,10,$res->elem_award,0);
    
    $pdf->Ln();


 
    
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(60,10,"High School: ",0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(60,10,$res->high_school,0);
    
    $pdf->Ln();

    
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(60,10,"High School Address: ",0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(60,10,$res->high_address,0);
    
    $pdf->Ln();

    
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(60,10,"Year Graduated: ",0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(60,10,$res->high_grad,0);
    
    $pdf->Ln();


 
    
    $pdf->SetFont('Arial', 'B',12);

    $pdf->Cell(60,10,"High School Award/s: ",0);

    $pdf->SetFont('Arial', '',12);

    $pdf->Cell(60,10,$res->high_award,0);
    
    $pdf->Ln();


 

    $pdf->Output();
   
}