<?php
  require __DIR__ . '/vendor/autoload.php';
  require __DIR__ . '/generated-conf/config.php';
  use Ramsey\Uuid\Uuid;
  
 
  function uploadMajor(){
    $major = new Major();
    $major->setId(0);
    $major->setName("Computing and Information Technologies BS");
    $major->setGrad(false);
    $major->save();

    $major = new Major();
    $major->setId(1);
    $major->setName("Digital Humanities and Social Sciences BS");
    $major->setGrad(false);
    $major->save();

    $major = new Major();
    $major->setId(2);
    $major->setName("Human-Centered Computing BS");
    $major->setGrad(false);
    $major->save();

    $major = new Major();
    $major->setId(3);
    $major->setName("Web and Mobile Computing BS");
    $major->setGrad(false);
    $major->save();

    $major = new Major();
    $major->setId(4);
    $major->setName("Other Undergrad");
    $major->setGrad(false);
    $major->save();

    $major = new Major();
    $major->setId(5);
    $major->setName("Health Informatics: Online MS");
    $major->setGrad(true);
    $major->save();

    $major = new Major();
    $major->setId(6);
    $major->setName("Human-Computer Interaction MS");
    $major->setGrad(true);
    $major->save();

    $major = new Major();
    $major->setId(7);
    $major->setName("Information Technology and Analytics MS");
    $major->setGrad(true);
    $major->save();

    $major = new Major();
    $major->setId(8);
    $major->setName("Web Development (Advanced Certificate)");
    $major->setGrad(true);
    $major->save();

    $major = new Major();
    $major->setId(9);
    $major->setName("Data Science: Online MS");
    $major->setGrad(true);
    $major->save();

    $major = new Major();
    $major->setId(10);
    $major->setName("Other Graduate");
    $major->setGrad(true);
    $major->save();
  }

  function uploadRole(){
    $role = new Role();
    $role->setId(0);
    $role->setName("Admin");
    $role->save();

    $role = new Role();
    $role->setId(1);
    $role->setName("Receptionist");
    $role->save();

    $role = new Role();
    $role->setId(2);
    $role->setName("Advisor");
    $role->save();

    $role = new Role();
    $role->setId(3);
    $role->setName("Media Editor");
    $role->save();
  }

  function uploadEmployee(){
    $employee = new Employee();
    $employee->setUid("mchics");
    $employee->setName("Melissa Hanna");
    $employee->setPictureUrl("https://claws.rit.edu/photos/getphotoid.php?Client=Marketing&UN=mchics&HASH=d504e26d751f87ca723a2335e51037f0ad8d9a30&T=1635266291");
    $employee->setRoleId(0);
    $employee->save();

    $employee = new Employee();
    $employee->setUid("jsfrla");
    $employee->setName("Jennifer Frantz");
    $employee->setPictureUrl("https://claws.rit.edu/photos/getphotoid.php?Client=Marketing&UN=jsfrla&HASH=b5e2b027308d899774c6e05a405bd42afe742198&T=1635266561");
    $employee->setRoleId(2);
    $employee->setIsGradAdvisor(false);
    $employee->setFirstLetter("M");
    $employee->setLastLetter("Z");
    $employee->save();

    $employee = new Employee();
    $employee->setUid("mfkiao");
    $employee->setName("Melody Klein");
    $employee->setPictureUrl("https://claws.rit.edu/photos/getphotoid.php?Client=Marketing&UN=mfkiao&HASH=f1e1d678acd27292367da87d1f5a449dc0011b56&T=1635266225");
    $employee->setRoleId(2);
    $employee->setIsGradAdvisor(false);
    $employee->setFirstLetter("A");
    $employee->setLastLetter("L");
    $employee->save();

    $employee = new Employee();
    $employee->setUid("thgics");
    $employee->setName("Theresa Gorecki");
    $employee->setRoleId(2);
    $employee->setIsGradAdvisor(true);
    $employee->setFirstLetter("A");
    $employee->setLastLetter("Z");
    $employee->save();

    $employee = new Employee();
    $employee->setUid("vm3132");
    $employee->setName("Vladimir Martynenko");
    $employee->setRoleId(0);
    $employee->save();

    $employee = new Employee();
    $employee->setUid("fda9891");
    $employee->setName("Fred Amartey");
    $employee->setRoleId(0);
    $employee->save();

    $employee = new Employee();
    $employee->setUid("cbc3368");
    $employee->setName("Charlie Cohen");
    $employee->setRoleId(0);
    $employee->save();

    $employee = new Employee();
    $employee->setUid("lxh5395");
    $employee->setName("Logan Hebert");
    $employee->setRoleId(0);
    $employee->save();

    $employee = new Employee();
    $employee->setUid("rk2384");
    $employee->setName("Raghul Krishnan");
    $employee->setRoleId(0);
    $employee->save();

    $employee = new Employee();
    $employee->setUid("sjzics");
    $employee->setName("Stephen Zilora");
    $employee->setRoleId(0);
    $employee->save();

    $employee = new Employee();
    $employee->setUid("echics");
    $employee->setName("Betty Hillman");
    $employee->setRoleId(0);
    $employee->save();
  }

  function uploadStudent(){
    $student = new Student();
    $student->setUid("uab1234");
    $student->setName("Test Student 1");
    $student->setMajorId(0);
    $student->setAdvisorId("echics");
    $student->save();

    $student = new Student();
    $student->setUid("ub1234");
    $student->setName("Test Student 2");
    $student->setMajorId(3);
    $student->save();

    $student = new Student();
    $student->setUid("ga1234");
    $student->setName("Grad Student 1");
    $student->setMajorId(9);
    $student->save();

    $student = new Student();
    $student->setUid("da1234");
    $student->setName("Undergrad D Student");
    $student->setMajorId(1);
    $student->save();
  }

  function uploadReason(){
    $reason = new Reason();
    $reason->setName("Next Semester Planning");
    $reason->setIsGrad(false);
    $reason->save();

    $reason = new Reason();
    $reason->setName("Problems with Registration");
    $reason->setIsGrad(false);
    $reason->save();

    $reason = new Reason();
    $reason->setName("Update Worksheet");
    $reason->setIsGrad(false);
    $reason->save();

    $reason = new Reason();
    $reason->setName("Leave Of Absence/Institute Withdrawal");
    $reason->setIsGrad(false);
    $reason->save();

    $reason = new Reason();
    $reason->setName("Change Of Program – out");
    $reason->setIsGrad(false);
    $reason->save();

    $reason = new Reason();
    $reason->setName("Course Withdrawal");
    $reason->setIsGrad(false);
    $reason->save();

    $reason = new Reason();
    $reason->setName("Waitlist");
    $reason->setIsGrad(false);
    $reason->save();

    $reason = new Reason();
    $reason->setName("Faculty/Grade Concern");
    $reason->setIsGrad(false);
    $reason->save();

    $reason = new Reason();
    $reason->setName("Received an Early Alert");
    $reason->setIsGrad(false);
    $reason->save();

    $reason = new Reason();
    $reason->setName("Transfer Credit/AP");
    $reason->setIsGrad(false);
    $reason->save();

    $reason = new Reason();
    $reason->setName("Request for Resource Info");
    $reason->setIsGrad(false);
    $reason->save();

    $reason = new Reason();
    $reason->setName("Minor/Concentration Selection");
    $reason->setIsGrad(false);
    $reason->save();

    $reason = new Reason();
    $reason->setName("Graduation Questions");
    $reason->setIsGrad(false);
    $reason->save();

    $reason = new Reason();
    $reason->setName("Personal Issue");
    $reason->setIsGrad(false);
    $reason->save();

    $reason = new Reason();
    $reason->setName("Other (Undergrad)");
    $reason->setIsGrad(false);
    $reason->save();

    $reason = new Reason();
    $reason->setName("Add/Drop/Enrollment");
    $reason->setIsGrad(true);
    $reason->save();

    $reason = new Reason();
    $reason->setName("SACM/Cultural Mission Letters");
    $reason->setIsGrad(true);
    $reason->save();

    $reason = new Reason();
    $reason->setName("FTE RCL Forms");
    $reason->setIsGrad(true);
    $reason->save();

    $reason = new Reason();
    $reason->setName("MCC Course Approval");
    $reason->setIsGrad(true);
    $reason->save();

    $reason = new Reason();
    $reason->setName("Other (Graduate)");
    $reason->setIsGrad(true);
    $reason->save();
  }

  function uploadModality(){
    $modality = new Modality();
    $modality->setName("In person");
    $modality->save();

    $modality = new Modality();
    $modality->setName("Remote");
    $modality->save();
  }

  function uploadVisit(){
    $visit = new Visit();
    $visit->setId(Uuid::uuid4());
    $visit->setAdvisorId("mfkiao");
    $visit->setStudentId("ub1234");
    $visit->setReasonId(1);
    $visit->setModality(ModalityQuery::create()->findOneByName("In Person"));
    $visit->setCreatedAt(new DateTime("now", new DateTimeZone('America/New_York')));
    $visit->setPosition(0);
    $visit->save();

    $visit = new Visit();
    $visit->setId(Uuid::uuid4());
    $visit->setAdvisorId("mfkiao");
    $visit->setStudentId("ga1234");
    $visit->setReasonId(1);
    $visit->setModality(ModalityQuery::create()->findOneByName("In Person"));
    $visit->setCreatedAt(new DateTime("now", new DateTimeZone('America/New_York')));
    $visit->setPosition(1);
    $visit->save();

    $visit = new Visit();
    $visit->setId(Uuid::uuid4());
    $visit->setAdvisorId("mfkiao");
    $visit->setStudentId("uab1234");
    $visit->setReasonId(1);
    $visit->setModality(ModalityQuery::create()->findOneByName("In Person"));
    $visit->setCreatedAt(new DateTime("now", new DateTimeZone('America/New_York')));
    $visit->setPosition(2);
    $visit->save();

    $visit = new Visit();
    $visit->setId(Uuid::uuid4());
    $visit->setAdvisorId("jsfrla");
    $visit->setStudentId("ga1234");
    $visit->setReasonId(1);
    $visit->setModality(ModalityQuery::create()->findOneByName("In Person"));
    $visit->setCreatedAt(new DateTime("now", new DateTimeZone('America/New_York')));
    $visit->setPosition(0);
    $visit->save();

  }

  // function uploadQueuePosition(){
  //   $visit = VisitQuery::create()->filterByAdvisorId("mfkiao")->filterByStudentId("ub1234")->findOne();
  //   $queuePosition = new QueuePosition();
  //   $queuePosition->setPosition(0);
  //   $queuePosition->setVisit($visit);
  //   $queuePosition->save();

  //   $queuePosition = new QueuePosition();
  //   $queuePosition->setPosition(1);
  //   $visit = VisitQuery::create()->filterByAdvisorId("mfkiao")->filterByStudentId("ga1234")->findOne();
  //   $queuePosition->setVisit($visit);
  //   $queuePosition->save();

  //   $queuePosition = new QueuePosition();
  //   $queuePosition->setPosition(2);
  //   $visit = VisitQuery::create()->filterByAdvisorId("mfkiao")->filterByStudentId("uab1234")->findOne();
  //   $queuePosition->setVisit($visit);
  //   $queuePosition->save();

  //   $queuePosition = new QueuePosition();
  //   $queuePosition->setPosition(0);
  //   $visit = VisitQuery::create()->filterByAdvisorId("jsfrla")->filterByStudentId("ga1234")->findOne();
  //   $queuePosition->setVisit($visit);
  //   $queuePosition->save();
  // }

  function uploadWalkinHour(){
    $walkinHour = new WalkinHour();
    $walkinHour->setAdvisorId(EmployeeQuery::create()->findOneByName("Melody Klein")->getUid());
    $startTime = (new DateTime("now", new DateTimeZone('America/New_York')))->modify("-1 hour");
    $walkinHour->setStartsAt($startTime);
    $endTime = (new DateTime("now", new DateTimeZone('America/New_York')))->modify("+1 hour");
    $walkinHour->setEndsAt($endTime);
    $walkinHour->save();

    $walkinHour = new WalkinHour();
    $walkinHour->setAdvisorId(EmployeeQuery::create()->findOneByName("Jennifer Frantz")->getUid());
    $startTime = (new DateTime("now", new DateTimeZone('America/New_York')))->modify("-1 hour");
    $walkinHour->setStartsAt($startTime);
    $endTime = (new DateTime("now", new DateTimeZone('America/New_York')))->modify("+1 hour");
    $walkinHour->setEndsAt($endTime);
    $walkinHour->save();

    $walkinHour = new WalkinHour();
    $walkinHour->setAdvisorId(EmployeeQuery::create()->findOneByName("Theresa Gorecki")->getUid());
    $startTime = (new DateTime("now", new DateTimeZone('America/New_York')))->modify("-1 hour");
    $walkinHour->setStartsAt($startTime);
    $endTime = (new DateTime("now", new DateTimeZone('America/New_York')))->modify("+1 hour");
    $walkinHour->setEndsAt($endTime);
    $walkinHour->save();
  }

  function uploadAds(){
    $ad = new Ad();
    $ad->setId("5df27802-b3d1-4545-93ca-398ee2959f9b");
    $ad->setFilename("BigTalk.jpg");
    $ad->save();

    $ad = new Ad();
    $ad->setId("d87dcec9-86a6-45aa-8021-b654bedd8241");
    $ad->setFilename("SpringRegistration.jpg");
    $ad->save();
  }

uploadMajor();
uploadRole();
uploadEmployee();
uploadStudent();
uploadReason();
uploadModality();
uploadVisit();
uploadWalkinHour();
uploadAds();
