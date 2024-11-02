Introduction : –

The SRS Electrical appliances are the manufacturers of some electrical products like switch gears, fuses, capacitors, resistors, etc…. These products after manufactured they are sent for testing where the product is subjected to some testing conditions, and then after the testing is successful at their laboratories they are sent to CPRI for further testing process, so that they can get it approved from CPRI and then release the product into the market. If the testing fails then the product is sent back for re-manufacturing it and then they are again subjected to tests.

Existing Scenario : –

Initially after the product is manufactured the companies testing department tests the product and maintains the details of the testing done like the type of testing and as well the result of the testing that the product is subjected to. Actually the testing process usually depends on the type of the product to be tested.

Actually the testing records are maintained in papers and they mark how many products are sent for testing and as well how many are tested successfully and as well how any are not. Actually each product that is manufactured is allocated with some product id (10 digit code which includes the product code, the revise of the product, and the manufacturing number) and the records of testing are maintained based on the product id so that it becomes easier to track which product is tested successfully and which has failed the testing, and what all are needed to be done to over come the defaults, so that the products that are failed when subjected to tests can be sent for re-making.

It has become a tedious job as there is no automation in the process and as well it is a time consuming process for maintaining the records of testing and filing it, as it has to be shown to the concerned department, as based on the results of testing they decide whether to send the product for further testing process or for re-making the product.

Some times misplacing of the records or the products take place or it might even happen like the record of one product is entered for the other, etc….. as in the testing department itself there are various departments which are based on the type of testing, and a product need two or more types of testing. As soon as a testing is finished in one department it is to be sent to the other department that performs the other type of testing.

Proposed Solution : –

In order to avoid the confusion in maintaining the records, misplacement of the records, and to reduce the time consumption in entering and fetching the details they want an application to be built that holds all the information of the testing like the type of testing conducted, result and even they should be able to capture the type of the testing done. 

They say that they want the application in modular and sub modular form depending on the type of the testing and as well based on the type of the product. One should be able to access the product based on the product id or testing id. As soon as a testing record is entered the unique test id (12 digit code which includes the product code, the revise of the product, and as well the testing code and the testing roll number) should be generated automatically. They also say that they want an advanced search option through which they can fetch the details at an ease.

They also want the application to hold the detailed remarks where one can enter the testing is done based on which criteria, and what is the output seen for that testing, etc…. 

►Non-Financial :

•	The details of the products and the testing like the product code, product id, testing id, the revise, the testing performed, remarks provided, the result of the testing, etc…. are needed to be maintained in a separate database.
•	Product id should be a unique 10 digit code as described by the manufacturing unit and the testing id should be a unique 12 digit code, which should be automatically generated.
•	An advanced search option is to be included.
•	The application should contain a modular and the sub-modular form based on the type of the product and as well based on the type of the testing.
•	One should be able to capture the detailed description of the remarks that include about the testing and what should be the output for that testing and the result of testing performed and as well the remarks if any for that particular product.
•	One should be able to check the status of the testing.
•	After entering the record, it should even ask for the name of the person (s) who has tested the product.
 
►Financial : 

After the product is subjected for testing and if it fails it is to be sent for re-making else it will be sent for further testing procedures that are held by the CPRI and get it approved from them so as to release the product in to the market. 

Functional Requirements : –

•	The details are needed to be captured based on the type of the testing and as well based on the product.
•	The status of the testing and as well the detailed remarks is also needed to be captured.
•	An advanced search option is needed to be included so that one can fetch the details of the testing at an ease.

XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX INSTRUCTIONS TO RUN BEGIN FROM HERE
INSTRUCTIONS TO RUN BEGIN FROM HERE XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

first step you need to do after opening this file and running xampp, appache and mysql is pasting this on your browser http://localhost/E_Project_SRS_Electronics/install.php

The username and password is: ('testuser', MD5('testpassword'));

WHILE SEARCHING FOR RECORDS USE THE IDs: SWG1234567, FUS7890123, CAP4567890


Test datas

INSERT INTO products (product_id, product_name, revise, manufacture_date)
VALUES ('SWG1234567', 'Switch Gear Model X', 1, '2024-08-30');
INSERT INTO testing (test_id, product_id, test_type, test_date, tester_name, test_result, remarks, status)
VALUES ('SWG123456701', 'SWG1234567', 'High Voltage Test', '2024-08-31', 'John Doe', 'pass', 'Tested successfully under standard conditions', 'completed');


INSERT INTO products (product_id, product_name, revise, manufacture_date)
VALUES ('FUS7890123', 'Fuse Model A', 2, '2024-08-28');
INSERT INTO testing (test_id, product_id, test_type, test_date, tester_name, test_result, remarks, status)
VALUES ('FUS789012301', 'FUS7890123', 'Short Circuit Test', '2024-08-29', 'Jane Smith', 'fail', 'Fuse blew out under test conditions', 'completed');


INSERT INTO products (product_id, product_name, revise, manufacture_date)
VALUES ('CAP4567890', 'Capacitor Model B', 1, '2024-08-25');
INSERT INTO testing (test_id, product_id, test_type, test_date, tester_name, test_result, remarks, status)
VALUES ('CAP456789001', 'CAP4567890', 'Capacitance Measurement', '2024-08-26', 'Michael Brown', 'pass', 'Capacitance within acceptable range', 'completed');


also in info.txt 


