<?php
    include_once "DatabaseConnector.php";
    session_start();

    class ServerFunctions extends DatabaseConnector {
        function addUser($lName, $fName, $mName, $birthday, $gender, $address, $telNo, $cellNo, $username, $password) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("INSERT INTO users VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?)");
            $sql->execute(array($lName, $fName, $mName, $birthday, $gender, $address, $telNo, $cellNo));

            $id = $this->dbHolder->lastInsertId();

            $sql = $this->dbHolder->prepare("INSERT INTO accounts VALUES (?, ?, password(?), ?);");
            $sql->execute(array($id, $username, $password, "client"));

            $this->closeConnection();
        }

        function login($username, $password) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("SELECT * FROM users u, accounts a WHERE u.user_id = a.user_id AND a.username=? AND a.password=password(?);");
            $sql->execute(array($username, $password));

            $content = $sql->fetch();
            if($content != null) {
                $data = array("user_id"=>$content[0], "name"=>$content[2]." ".$content[3]." ".$content[1], "birthday"=>$content[4],
                              "gender"=>$content[5], "address"=>$content[6], "telNo"=>$content[7], "cellNo"=>$content[8], "type"=>$content[12]);
                $_SESSION['currentUsername'] = $username;
                $_SESSION['currentUserID'] = $content[0];
                $_SESSION['currentUserType'] = $content[12];
                echo json_encode($data);
            }

            $this->closeConnection();
        }

        //----------------- packages & products ----------------
        function addPackage($name, $desc, $price, $imageExtension) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("INSERT INTO packages VALUES (null, ?, ?, ?, null, 1)");
            $sql->execute(array(htmlentities($name), nl2br(htmlentities($desc)), $price));

            $newName = "";
            if($imageExtension != "") {
                $id = $this->dbHolder->lastInsertId();
                $newName = $id.".".$imageExtension;
                $sql = $this->dbHolder->prepare("UPDATE packages SET photo = ? WHERE packageId = ?;");
                $sql->execute(array($newName, $id));
            }
            $this->closeConnection();

            return $newName;
        }

        function addProduct($name, $desc, $unitPrice, $sellingPrice, $stock, $imageExtension, $category) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("INSERT INTO products VALUES (null, ?, ?, ?, ?, ?, null, ?);");
            $sql->execute(array(htmlentities($name), nl2br(htmlentities($desc)), $unitPrice, $sellingPrice, $stock, $category));

            $newName = "";
            if($imageExtension != "") {
                $id = $this->dbHolder->lastInsertId();
                $newName = $id.".".$imageExtension;
                $sql = $this->dbHolder->prepare("UPDATE products SET photo = ? WHERE prodId = ?;");
                $sql->execute(array($newName, $id));
            }
            $this->closeConnection();

            return $newName;
        }

        function updatePackage($name, $desc, $price, $status, $id) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("UPDATE packages SET name = ?, description = ?, price = ?, status = ? WHERE packageId = ?;");
            $sql->execute(array(htmlentities($name), nl2br(htmlentities($desc)), $price, $status, $id));

            $this->closeConnection();
        }

        function updateProduct($name, $desc, $unitPrice, $sellingPrice, $stocks, $category, $id) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("UPDATE products SET name = ?, description = ?, unitPrice = ?, sellingPrice = ?, stocks = ?, category = ? WHERE prodId = ?;");
            $sql->execute(array(htmlentities($name), nl2br(htmlentities($desc)), $unitPrice, $sellingPrice, $stocks, $category, $id));

            $this->closeConnection();
        }

        function displayPackages() {
            $this->openConnection();

            $sql = $this->dbHolder->query("SELECT * FROM packages;");
            $data = "";
            $status = "invalid status";
            while($content = $sql->fetch()) {
                if($content[5] == 1) $status = "available";
                else if($content[5] == 0) $status = "out-of-stock";
                $data.= "<tr id='".$content[0]."'>
                            <td id='".$content[0]."name'>".$content[1]."</td>
                            <td id='".$content[0]."desc'>".$content[2]."</td>
                            <td id='".$content[0]."price'>".$content[3]."</td>
                            <td id='".$content[0]."status'>".$status."</td>
                            <td>
                                <a onclick='viewPackagePhoto(".$content[0].")'>view photo</a> |
                                <a onclick='editPackage(".$content[0].")'>edit</a> |
                                <a onclick='deletePackage(".$content[0].")'>remove</a>

                            </td>
                         </tr>";
            }
            if($data == "") echo "No packages available";
            else echo "<tr><th>Package Name</th><th>Description</th><th>Price</th><th>Status</th><th>Action</th></tr>".$data;

            $this->closeConnection();
        }

        function displayProductsAdmin() {
            $this->openConnection();

            $sql = $this->dbHolder->query("SELECT DISTINCT category FROM products;");
            $data = "";
            //$status = "invalid status";
            while($category = $sql->fetch()) {
                $sql2 = $this->dbHolder->prepare("SELECT * FROM products WHERE category = ?;");
                $sql2->execute(array($category[0]));

                $sql3 = $this->dbHolder->prepare("SELECT COUNT(*) FROM products WHERE category = ?;");
                $sql3->execute(array($category[0]));

                if($sql3->fetch()[0] > 0) {
                    $data .= "<tr class='alert alert-success'><th colspan='6' style='text-align: center; background:'>".$category[0]."</th></th>";
                    $data .= "<tr><th>Name</th><th>Description</th><th>Unit price</th><th>Selling Price</th><th>Stocks</th>><th>Action</th></tr>";
                }

                while($content = $sql2->fetch()) {
                    //if($content[5] == 1) $status = "available";
                    //else if($content[5] == 0) $status = "out-of-stock";
                    // <td id='".$content[0]."status'>".$status."</td>
                    $data.= "<tr id='prod".$content[0]."'>
                                <td id='".$content[0]."name'>".$content[1]."</td>
                                <td id='".$content[0]."desc'>".$content[2]."</td>
                                <td id='".$content[0]."unitPrice'>".$content[3]."</td>
                                <td id='".$content[0]."sellingPrice'>".$content[4]."</td>
                                <td id='".$content[0]."stocks'>".$content[5]."</td>
                                <td>
                                    <a onclick='viewProductPhoto(".$content[0].")'>view photo</a> |
                                    <a onclick='editProduct(".$content[0].")'>edit</a> |
                                    <a onclick='deleteProduct(".$content[0].")'>remove</a>

                                </td>
                             </tr>";
                }
            }
            if($data == "") echo "No products available";
            else echo $data;

            $this->closeConnection();
        }

        function getPackagePhoto($id) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("SELECT name, photo FROM packages WHERE packageId = ?;");
            $sql->execute(array($id));

            $content = $sql->fetch();
            $data = "<p><label>Package Name: </label> <span id='packageNameToUpdate'>".$content[0]."</span></p>";
            if($content[1] != NULL || $content[1] != "") $data .= "<img class='adminPackagePhoto' src='../files/packagesPhotos/".$content[1]."' /><br /><span class='label label-info'>Change Photo?</span>";
            else $data .= "<h3><span class='label label-default'>No image available.</span></h3><br /><span class='label label-info'>Add Photo?</span>";
            $data .= "<input type='file' name='newPackagePhoto' onchange='updatePackagePhoto(this)' class='form-control' /> <br />
                      <button onclick='changePackagePhoto(".$id.")' class='btn btn-primary form-control'>upload and save photo</button>";

            echo $data;

            $this->closeConnection();
        }

        function getProductPhoto($id) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("SELECT name, photo FROM products WHERE prodId = ?;");
            $sql->execute(array($id));

            $content = $sql->fetch();
            $data = "<p><label>Product Name: </label> <span id='prodNameToUpdate'>".$content[0]."</span></p>";
            if($content[1] != NULL || $content[1] != "") $data .= "<img class='adminPackagePhoto' src='../files/productsPhotos/".$content[1]."' /><br /><span class='label label-info'>Change Photo?</span>";
            else $data .= "<h3><span class='label label-default'>No image available.</span></h3><br /><span class='label label-info'>Add Photo?</span>";
            $data .= "<input type='file' name='newProductPhoto' onchange='updateProductPhoto(this)' class='form-control' /> <br />
                      <button onclick='changeProductPhoto(".$id.")' class='btn btn-info form-control'>upload and save new photo</button>";

            echo $data;

            $this->closeConnection();
        }


        function changePackagePhoto($id, $newName, $packageName) {
            $this-> openConnection();

            $sql = $this->dbHolder->prepare("UPDATE packages set photo = ? WHERE packageId = ?;");
            $sql->execute(array($newName, $id));

            $this->closeConnection();

            $data = "<p><label>Package Name: </label> <span id='packageNameToUpdate'>".$packageName."</span></p>
                     <img class='adminPackagePhoto' src='../files/packagesPhotos/".$newName."' /><br /><label>Change image: </label>
                     <input type='file' name='newPackagePhoto' onchange='updatePackagePhoto(this)' class='form-control' /> <br />
                     <button onclick='changePackagePhoto(".$id.")' class='btn btn-primary form-control'>upload and save photo</button>";
            echo $data;
        }

        function changeProductPhoto($id, $newName, $packageName) {
            $this-> openConnection();

            $sql = $this->dbHolder->prepare("UPDATE products set photo = ? WHERE prodId = ?;");
            $sql->execute(array($newName, $id));

            $this->closeConnection();

            $data = "<p><label>Product Name: </label> <span id='prodNameToUpdate'>".$packageName."</span></p>
                     <img class='adminProductPhoto' src='../files/productsPhotos/".$newName."' /><br /><label>Change image: </label>
                     <input type='file' name='newProductPhoto' onchange='updateProductPhoto(this)' class='form-control' /> <br />
                     <button onclick='changeProductPhoto(".$id.")' class='btn btn-info form-control'>upload and save photo</button>";
            echo $data;
        }

        function deletePackage($id) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("DELETE FROM packages WHERE packageId = ?;");
            $sql->execute(array($id));

            $this->closeConnection();
        }

        function deleteProduct($id) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("DELETE FROM products WHERE prodId = ?;");
            $sql->execute(array($id));

            $this->closeConnection();
        }

        function displayTransactionsToAdmin() {
            $this->openConnection();

            $sql = $this->dbHolder->query("SELECT t.transId, t.dateOfTransaction, u.firstname, u.lastname, t.status, t.method
                                             FROM users u, transactions t WHERE u.user_id = t.userId ORDER BY t.status, t.transId DESC;");

            $data = "";
            while($content = $sql->fetch()) {
                if($content[4] == 1) $status = "<span><span class='glyphicon glyphicon-check'></span> DONE</span>";
                else $status = "<span style='color:red;'>UNPROCESSED</span>";

                $sql1 = $this->dbHolder->prepare("SELECT status FROM payments WHERE transId = ?;");
                $sql1->execute(array($content[0]));

                $payment = "<label style='color: red;'>UNPAID</label>";
                while($paymentContent = $sql1->fetch()) {
                    if($paymentContent[0] == 1) $payment = "<label>PAID</label>";
                    else $payment = "<label style='color: orange'>UNCONFIRMED</label>";
                }

                $data .= "<tr>
                            <td onclick='showTransactionDetails(".$content[0].")'><a><span class='glyphicon glyphicon-blackboard'></span>  show details</a></td>
                            <td>".$content[1]."</td>
                            <td>".$content[2]." ".$content[3]."</td>
                            <td>".$content[5]."</td>
                            <td>".$payment."</td>
                            <td>".$status."</td>
                          </tr>";
            }

            if($data != "") {
                $data = "<tr>
                            <th>Action</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Method</th>
                            <th>Payment Status</th>
                            <th>Remarks</th>
                         </tr>".$data;
            } else {
                $data = "<tr class='alert alert-danger'><th>No Transactions Yet</th></tr>";
            }
            echo $data;
            $this->closeConnection();
        }

        function showTransactionDetails($transId) {
            $this->openConnection();

            $sql0 = $this->dbHolder->prepare("SELECT u.lastname, u.firstname, u.middlename, u.address, u.telNo, u.cellNo, t.dateOfTransaction, u.user_id FROM users u, transactions t WHERE u.user_id = t.userId AND t.transId = ?;");
            $sql0->execute(array($transId));

            $data = "<h4 class='alert alert-info'>
                        <label>Transaction Details</label>
                        <a href='../a-orders' class='btn btn-info pull-right'>
                            <span class='glyphicon glyphicon-chevron-left'></span> Back
                        </a>
                       </h4>
                       <table class='table-responsive table'><tr>";
            if($userInfo = $sql0->fetch()) {
                $data .= "<td><label>Date Ordered: </label> ".$userInfo[6];
                $data .= "<br /><span class='glyphicon glyphicon-user'></span> ".$userInfo[0].", ".$userInfo[1]." ".$userInfo[2];
                $data .= "<br /><span class='glyphicon glyphicon-envelope'></span> ".$userInfo[3];
                $data .= "<br /><span class='glyphicon glyphicon-phone'></span> ".$userInfo[4];
                $data .= "<br /><span class='glyphicon glyphicon-phone'></span> ".$userInfo[5]." </td>";
                $data .= "<td valign='top'><button class='btn btn-sm btn-default pull-right' onclick='sendMessageTo(".$userInfo[7].")'><span class='glyphicon glyphicon-envelope'></span> Send ".$userInfo[1]." a Message</button></td>";
            }
            $data .= "</tr></table>";

            $data .= "<h5 class='alert alert-info'><label>Order Information</label></h5>";
            $sql = $this->dbHolder->prepare("SELECT * FROM orderedItems WHERE transId = ?;");
            $sql->execute(array($transId));
            $data .= "<table class='table table-responsive table-hover'>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>";
            $sum = 0;
            while($content = $sql->fetch())  {
                $sql2 = null;
                if($content[2] == "product") {
                    $sql2 = $this->dbHolder->prepare("SELECT name, sellingPrice FROM products WHERE prodId = ?;");
                    $sql2->execute(array($content[3]));
                } else {
                    $sql2 = $this->dbHolder->prepare("SELECT name, price FROM packages WHERE packageId = ?;");
                    $sql2->execute(array($content[3]));
                }
                $detail = $sql2->fetch();
                $data .= "<tr>
                            <td>".$detail[0]."</td>
                            <td>".$detail[1]."</td>
                            <td>".$content[4]."</td>
                            <td>".($detail[1]*$content[4])."</td>
                          </tr>";
                $sum += ($detail[1]*$content[4]);
            }
            $data .= "<tr class='alert-success'><th colspan='3'>TOTAL AMOUNT </th><th>".$sum.".00</th></tr></table>";

            $sql4 = $this->dbHolder->prepare("SELECT * FROM payments WHERE transID = ?;");
            $sql4->execute(array($transId));

            $payment = "<h5 class='alert alert-danger'>UNPAID</h5>";
            if($paymentInfo = $sql4->fetch()) {
                if($paymentInfo[6] == 1) {
                    $payment = "<h5 class='alert alert-info'><label>Proof of Payment</label>&nbsp;&nbsp; [ PAYMENT CONFIRMED <span class='glyphicon glyphicon-thumbs-up'></span> ]</h5></div>";
                    $payment .= "<img src='../files/proofOfPaymentPhotos/".$paymentInfo[3]."' />
                                 <p>".$paymentInfo[4]."</p><br /></div>";
                } else { // 0 means unconfirmed payment
                    $payment = "<h5 class='alert alert-info'><label>Proof of Payment</label> <button onclick='confirmProofOfPayment(".$transId.")' class='btn btn-warning pull-right'> CONFIRM PAYMENT</button></h5>";
                    $payment .= "<img src='../files/proofOfPaymentPhotos/".$paymentInfo[3]."' />
                                 <p>".$paymentInfo[4]."</p><br /></div>";
                }
            }

            $data .= $payment;

            $sql3 = $this->dbHolder->prepare("SELECT t.method, i.* FROM transactions t, orderInformation i WHERE t.transID = i.transId AND t.transID = ?;");
            $sql3->execute(array($transId));


            if($oInformation = $sql3->fetch()) {
                if($oInformation[0] == "delivery") {
                    $data .= "<h5 class='alert alert-info'><label>Delivery Information</label></h5>";
                    $data .= "<table class = 'table table-responsive table-hover'>";

                    $data .= "<tr><th>Where to Deliver: </th><td>".$oInformation[3]."</td></tr>";
                    $data .= "<tr><th>Name of the Receiver: </th><td>".$oInformation[4]."</td></tr>";
                    if($oInformation[5] != NULL) $data .= "<tr><th>Care Of: </th><td>".$oInformation[5]."</td></tr>";
                    $data .= "<tr><th>Contact Number of the Receiver: </th><td>".$oInformation[6]."</td></tr>";
                    $data .= "<tr><th>Payment Method: </th><td>".$oInformation[7]."</td></tr>";

                } else if($oInformation[0] == "ship") {
                    $data .= "<h5 class='alert alert-info'><label>Shipping Information</label></h5>";
                    $data .= "<table class = 'table table-hover'>";

                    $data .= "<tr><th>Where to Ship: </th><td>".$oInformation[3]."</td></tr>";
                    $data .= "<tr><th>Name of the Receiver: </th><td>".$oInformation[4]."</td></tr>";
                    if($oInformation[5] != NULL) $data .= "<tr><th>Care Of: </th><td>".$oInformation[5]."</td></tr>";
                    $data .= "<tr><th>Contact Number of the Receiver: </th><td>".$oInformation[6]."</td></tr>";
                    $data .= "<tr><th>Payment Method: </th><td>".$oInformation[7]."</td></tr>";
                } else {
                    $data .= "<h5 class='alert alert-info'><label>Pick-up Information</label></h5>";
                    $data .= "<table class = 'table table-responsive table-hover'>";

                    $data .= "<tr><th>Pick-up Date: </th><td>".$oInformation[8]."</td></tr>";
                    $data .= "<tr><th>Name of the person who will pick-up: </th><td>".$oInformation[4]."</td></tr>";
                    $data .= "<tr><th>Contact Number of the picker: </th><td>".$oInformation[6]."</td></tr>";
                    $data .= "<tr><th>Payment Method: </th><td>".$oInformation[7]."</td></tr>";
                }
            }
            $data .= "</table>";
            $data .= "<button onclick='confirmDelivery(".$transId.")' class='btn btn-info alert alert-info col-lg-12'><label>CLICK HERE TO CONFIRM THAT THIS ORDER IS ALREADY ADDRESSED</label></button>";
            echo $data;

            $this->closeConnection();
        }

        function confirmProofOfPayment($transID) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("UPDATE payments SET status = 1 WHERE transID = ?;");
            $sql->execute(array($transID));

            $this->closeConnection();
        }

        function confirmDelivery($transID) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("UPDATE transactions SET status = 1 WHERE transID = ?;");
            $sql->execute(array($transID));

            $this->closeConnection();
        }

        function sendMessageToAdmin($receiverId, $subject, $message) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("INSERT INTO messages VALUES (null, ?, ?, ?, ?, ?);");
            $sql->execute(array($_SESSION["currentUserID"], $receiverId,  htmlentities($subject), nl2br(htmlentities($message)), $this->getCurrentDate()));

            $this->closeConnection();
        }

        function displayAllMessages() {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("SELECT u.firstname, u.lastname, m.* FROM users u, messages m WHERE u.user_id = m.senderID AND m.receiverID = ? ORDER BY m.dateSent;");
            $sql->execute(array($_SESSION["currentUserID"]));

            $data = "";
            $counter = 1;
            while($content = $sql->fetch()) {
                if($counter % 2 == 0) $class = "alert alert-warning";
                else $class = "alert alert-success";
                $data .= "<tr class=''>
                          <td><p style='text-align: right;'><label>From: ".$content[0]." ".$content[1]." [".$content[7]."]</label></p>
                          <p>Re:<label>".$content[5]."</label></p>
                          <p>".$content[6]."</p></td>
                         </tr>";
                $counter++;
            }

            echo $data;

            $this->closeConnection();
        }

        //------------- functions for testimonials starts here

        function addTestimonial($title, $content, $nameAndAge, $imageExtension) {
            $this->openConnection();

            if($_SESSION['currentUserType'] == "admin") {
                $status = 1;
            } else {
                $status = 0;
            }

            $sql = $this->dbHolder->prepare("INSERT INTO testimonials VALUES (null, ?, ?, ?, ?, null, ?);");
            $sql->execute(array($_SESSION["currentUserID"], htmlentities($title), nl2br(htmlentities($content)), htmlentities($nameAndAge), $status));

            $id = $this->dbHolder->lastInsertId();
            $newName = $id.".".$imageExtension;
            $sql1 = $this->dbHolder->prepare("UPDATE testimonials SET photo = ? WHERE testimonialID = ?;");
            $sql1->execute(array($newName, $id));

            $this->closeConnection();

            return $newName;
        }

        function displayTestimonialsToAdmin() {
            $this->openConnection();

            if($_SESSION["currentUserType"] == "admin") {
                $sql = $this->dbHolder->query("SELECT u.firstname, u.middlename, u.lastname, t.* FROM users u, testimonials t
                                             WHERE u.user_id = t.userId ORDER BY t.testimonialId DESC;");
            } else {
                $sql = $this->dbHolder->prepare("SELECT u.firstname, u.middlename, u.lastname, t.* FROM users u, testimonials t
                                             WHERE u.user_id = t.userId AND u.user_id = ? ORDER BY t.testimonialId DESC;");
                $sql->execute(array($_SESSION["currentUserID"]));
            }


            $data = "";
            while($content = $sql->fetch()) {
                if($content[4] == $_SESSION["currentUserID"]) {
                    $data .= "<tr><td colspan='2'><span class='pull-left' style='color: green;'>Added by YOU</span>
                                <h4 id='testimonialTitle".$content[3]."'>\"<span>".$content[5]."</span>\"
                                <a class='pull-right clickable glyphicon glyphicon-edit' title='click to edit this title' onclick='editTestimonialTile(".$content[3].")'></a></h4></td> </tr>
                            <tr>
                                <td valign='top'>
                                    <img class='img-responsive' src= '../files/testimonialsPhotos/".$content[8]."'>
                                </td>
                                <td valign='top'><span id='testimonialContent".$content[3]."'><span id='content'>".$content[6]."</span>
                                    <a class='pull-right clickable glyphicon glyphicon-edit' title='click to edit this content' onclick='editTestimonialContent(".$content[3].")'></a></span>
                                    <h3 id='testimonialNameAndAge".$content[3]."'>--<span id='content'>".$content[7]."</span>
                                    <a class='pull-right clickable glyphicon glyphicon-edit' title='click to edit this information' onclick='editTestimonialNameAndAge(".$content[3].")'></a></h3>
                                </td>
                            </tr>";
                } else {
                    if($content[9] == "1") {
                        $status = "<span class='pull-right label label-info'><span class='glyphicon glyphicon-ok'></span> Approved</span>";
                    } else {
                        $status = "<button class='btn btn-sm btn-success pull-right' onclick='approveTestimonial(".$content[3].")'>
                                    <span class='glyphicon glyphicon-thumbs-up' area-hidden='true'></span> Approve this Testimonial
                                </button>";
                    }
                    $data .= "<tr><td colspan='2'>
                                <span class='pull-left' style='color: green;'>Added by ".$content[0]." ".$content[1]." ".$content[2]." </span>
                                <span id='testimonialStatus".$content[3]."'>".$status."</span>
                                <h4>\"".$content[5]."\"</h4></td> </tr>
                            <tr>
                                <td valign='top'>
                                    <img src= '../files/testimonialsPhotos/".$content[8]."'>
                                </td>
                                <td valign='top'><span id='content".$content[3]."'>".$content[6]."
                                    <h3 class=''>--".$content[7]."</h3>
                                </td>
                            </tr>";
                }

            }
            if($data == "") {
                $data = "<tr><td></td></tr><h6 class='alert alert-danger'>No testimonials added.</h6></td></tr>";
            }
            echo $data;
            $this->closeConnection();
        }

        function approveTestimonial($testimonialID) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("UPDATE testimonials SET status = 1 WHERE testimonialID = ?;");
            $sql->execute(array($testimonialID));

            $this->closeConnection();
        }

        function displayTestimonials() {
            $this->openConnection();

            $sql = $this->dbHolder->query("SELECT * FROM testimonials WHERE status = 1 ORDER BY testimonialId DESC;");

            $data = "";
            while($content = $sql->fetch()) {
                $data .= "<tr><td colspan='2'>
                            <h4>\"<span>".$content[2]."</span>\"</h4>
                          </td> </tr>
                        <tr>
                            <td valign='top'>
                                <img src= '../files/testimonialsPhotos/".$content[5]."'>
                            </td>
                            <td valign='top'><span id='content'>".$content[3]."</span>
                                <h3>--".$content[4]."</h3>
                            </td>
                        </tr>";
            }
            echo $data;
            $this->closeConnection();
        }

        function editTestimonialTitle($id, $title) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("UPDATE testimonials SET title = ? WHERE testimonialID = ?;");
            $sql->execute(array(htmlentities($title), $id));

            $this->closeConnection();
        }

        function editTestimonialContent($id, $content) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("UPDATE testimonials SET description = ? WHERE testimonialID = ?;");
            $sql->execute(array(nl2br(htmlentities($content)), $id));

            $this->closeConnection();
        }

        function editTestimonialNameAndAge($id, $nameAndAge) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("UPDATE testimonials SET nameAge = ? WHERE testimonialID = ?;");
            $sql->execute(array(htmlentities($nameAndAge), $id));

            $this->closeConnection();
        }

        function displayClientProfile() {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("SELECT u.*, a.* FROM users u, accounts a WHERE u.user_id = a.user_id AND u.user_id = ?;");
            $sql->execute(array($_SESSION["currentUserID"]));

            $data = "";
            while($content = $sql->fetch()) {
                $data .= "<tr><th>Given Name</th><td>".$content[2]."</td></tr>";
                $data .= "<tr><th>Middle Name</th><td>$content[3]</td></tr>";
                $data .= "<tr><th>Last Name</th><td>".$content[1]."</td></tr>";
                $data .= "<tr><th>Address</th><td>".$content[6]."</td></tr>";
                $data .= "<tr><th>Telephone No.</th><td>".$content[7]."</td></tr>";
                $data .= "<tr><th>Cellphone No.</th><td>".$content[8]."</td></tr>";
                $data .= "<tr><th>Username</th><td>".$content[10]."</td></tr>";
            }

            echo $data;

            $this->closeConnection();
        }

        function checkCodeEntered($code, $codeEntered) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("SELECT * FROM captchaCodes WHERE codeId = ? AND code = ?;");
            $sql->execute(array($code, $codeEntered));

            if($sql->fetch()) $result = "1";
            else $result = "0";

            $this->closeConnection();
            return $result;
        }

        function displayOrdersOnTheSpecifiedDate($date) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("SELECT t.transId, t.dateOfTransaction, u.firstname, u.lastname, t.status, t.method
                                             FROM users u, transactions t WHERE u.user_id = t.userId AND t.dateOfTransaction = ? ORDER BY t.status, t.transId DESC;");
            $sql->execute(array($date));

            $data = "";
            while($content = $sql->fetch()) {
                if($content[4] == 1) $status = "<span><span class='glyphicon glyphicon-check'></span> DONE</span>";
                else $status = "<span style='color:red;'><span class='glyphicon glyphicon-unchecked'></span> UNPROCESSED</span>";

                $sql1 = $this->dbHolder->prepare("SELECT status FROM payments WHERE transId = ?;");
                $sql1->execute(array($content[0]));

                $payment = "<label style='color: red;'>UNPAID</label>";
                while($paymentContent = $sql1->fetch()) {
                    if($paymentContent[0] == 1) $payment = "<label>PAID</label>";
                    else $payment = "<label style='color: orange'>UNCONFIRMED</label>";
                }

                $data .= "<tr>
                            <td onclick='showTransactionDetails(".$content[0].")'><a><span class='glyphicon glyphicon-blackboard'></span>  show details</a></td>
                            <td>".$content[1]."</td>
                            <td>".$content[2]." ".$content[3]."</td>
                            <td>".$content[5]."</td>
                            <td>".$payment."</td>
                            <td>".$status."</td>
                          </tr>";
            }

            if($data != "") {
                $data = "<tr>
                            <th>Action</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Method</th>
                            <th>Payment Status</th>
                            <th>Remarks</th>
                         </tr>".$data;
            } else {
                $data = "<tr class='alert alert-danger'><th>No Orders As Of ".$date."</th></tr>";
            }
            echo $data;
            $this->closeConnection();
        }

        function displaySalesRecord($category) {
            $this->openConnection();
            $data = "<h3 class='alert alert-info'>".$category." Sales Record</h3>";
            if($category == "Daily") {
                $sql = $this->dbHolder->query("SELECT MONTH(t.dateOfTransaction), DAY(t.dateOfTransaction), YEAR(t.dateOfTransaction), SUM(p.sellingprice*o.itemId)
                                                  FROM products p, orderedItems o, transactions t
                                                  WHERE p.prodId = o.itemId AND o.transID = t.transId AND t.status = 1
                                                  GROUP BY t.dateOfTRansaction;");
                $total = 0;
                while($content = $sql->fetch()) {
                    $data .= "<tr><td>".$this->getMonth($content[0])." ".$content[1].", ".$content[2]."</td><td>".$content[3].".00</td></tr>";
                    $total += $content[1];
                }
                if($data != "") {
                    $data .= "<tr><th>Total Sales</th><th>Php ".$total.".00</th></tr>";
                    $data = "<table class='table table-responsive table-hover'><tr><th>Date</th><th>Sales</th></tr>".$data."</table>";
                } else $data .= "<h4 class='alert alert-danger'>No sales record found.</h4>";
            } else if($category == "Monthly") {
                $sql = $this->dbHolder->query("SELECT DISTINCT YEAR(dateOfTransaction) from transactions;");
                $total = 0;
                $yearTotal = 0;
                while($year = $sql->fetch()) {
                    $sql1 = $this->dbHolder->prepare("SELECT MONTH(t.dateOfTransaction), SUM(p.sellingprice*o.itemId)
                                                  FROM products p, orderedItems o, transactions t
                                                  WHERE p.prodId = o.itemId AND o.transID = t.transId AND YEAR(t.dateOfTransaction) = ? AND t.status = 1
                                                  GROUP BY MONTH(t.dateOfTRansaction);");
                    $sql1->execute(array($year[0]));
                    while($content = $sql1->fetch()) {
                        $data .= "<tr><td>".$this->getMonth($content[0])." ".$year[0]."</td><td>".$content[1].".00</td></tr>";
                        $total += $content[1];
                        $yearTotal += $content[1];
                    }
                    $data .= "<tr><th>Total Sales For ".$year[0]."</th><td>".$yearTotal.".00</td></tr>";
                    $yearTotal = 0;
                }
                if($data != "") {
                    $data .= "<tr><th>Total Sales</th><th>Php ".$total.".00</th></tr>";
                    $data = "<table class='table table-responsive table-hover'><tr><th>Date</th><th>Sales</th></tr>".$data."</table>";
                } else $data .= "<h4 class='alert alert-danger'>No sales record found.</h4>";
            } else {
                $sql = $this->dbHolder->query("SELECT YEAR(t.dateOfTransaction), SUM(p.sellingprice*o.itemId)
                                                  FROM products p, orderedItems o, transactions t
                                                  WHERE p.prodId = o.itemId AND o.transID = t.transId AND t.status = 1
                                                  GROUP BY YEAR(t.dateOfTRansaction);");
                $total = 0;
                while($content = $sql->fetch()) {
                    $data .= "<tr><td>".$content[0]."</td><td>".$content[1].".00</td></tr>";
                    $total += $content[1];
                }
                if($data != "") {
                    $data .= "<tr><th>Total Sales</th><th>Php ".$total.".00</th></tr>";
                    $data = "<table class='table table-responsive table-hover'><tr><th>Date</th><th>Sales</th></tr>".$data."</table>";
                } else $data .= "<h4 class='alert alert-danger'>No sales record found.</h4>";
            }

            echo $data;

            $this->closeConnection();
        }

        function getMonthlySales($year) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("SELECT MONTH(t.dateOfTransaction), SUM(p.sellingprice*o.itemId) AS Total
                                                  FROM products p, orderedItems o, transactions t
                                                  WHERE p.prodId = o.itemId AND o.transID = t.transId AND YEAR(t.dateOfTransaction) = ? AND t.status = 1
                                                  GROUP BY MONTH(t.dateOfTRansaction);");
            $sql->execute(array($year));

            $monthlySales = $sql->fetchAll();

            $this->closeConnection();

            if($monthlySales == null){
                echo "";
            }else{
                $encoded = json_encode($monthlySales);
                echo $encoded;
            }
        }

        function getMonth($month) {
            $monthWord = "";
            switch($month) {
                case 1: $monthWord = "January"; break;
                case 2: $monthWord = "February"; break;
                case 3: $monthWord = "March"; break;
                case 4: $monthWord = "April"; break;
                case 5: $monthWord = "May"; break;
                case 6: $monthWord = "June"; break;
                case 7: $monthWord = "July"; break;
                case 8: $monthWord = "August"; break;
                case 9: $monthWord = "September"; break;
                case 10: $monthWord = "October"; break;
                case 11: $monthWord = "November"; break;
                case 12: $monthWord = "December"; break;
            }
                return $monthWord;
        }

        function getCurrentDate() {
            $sql = $this->dbHolder->query("SELECT CURDATE();");
            $data = $sql->fetch();

            return $data[0];
        }
    }