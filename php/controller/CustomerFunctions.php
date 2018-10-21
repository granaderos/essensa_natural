<?php
    include_once "DatabaseConnector.php";
    session_start();

    class CustomerFunctions extends DatabaseConnector {

        function displayAvailablePackages() {
            $this->openConnection();

            $sql = $this->dbHolder->query("SELECT * FROM packages WHERE status = 1");

            $data = "<div class='row'>";
            while($content = $sql->fetch()) {
                    $data .= "<div onmouseover='displayPackageInfo(".$content[0].")' onmouseout='hidePackageInfo(".$content[0].")' class='col-xs-6 col-sm-4' ><img alt='".$content[1]."' src='../files/packagesPhotos/".$content[4]."' /><br />
                                  <button id='btnAddToCart".$content[0]."' onclick='addToCart(".$content[0].")' class='btnAddToCart btn btn-primary pull-right'><span class='glyphicon glyphicon-shopping-my-cart'>&nbsp;</span>add to my-cart</button>
                                  <div id='pack".$content[0]."' class='hiddenInfo pull-left'>
                                    <span class=''>Package Name:</span><p class='infoValue'>".$content[1]."</p>
                                        <span class=''>Description:</span><p class='infoValue'>".$content[2]."</p>
                                        <span class=''>Price:</span> <p class='infoValue'>Php".$content[3]."</p>
                                  </div>
                              </div>";
            }
            echo $data;
            $this->closeConnection();
        }

        function displayAvailableProducts() {
            $this->openConnection();

            $sql = $this->dbHolder->query("SELECT * FROM products;");

            $data = "";
            $counter = 1;
            while($content = $sql->fetch()) {
                if($counter == 1) {
                    $data .= "<div class='row text-center'>";
                    $data .= "<div class='col-xs-10 col-sm-5 col-md-4 text-center'>
                                <a onclick='viewProduct(".$content[0].")'><img class='img-responsive' alt='".$content[1]."' width='100%' height='100%' src='../files/productsPhotos/".$content[6]."' /><br />
                                <div class='infoValue alert alert-success'>".$content[1]."</div></a>
                              </div>";
                } else if($counter == 3) {
                    $data .= "<div class='col-xs-10 col-sm-5 col-md-4 text-center'>
                                <a onclick='viewProduct(".$content[0].")'><img class='img-responsive' alt='".$content[1]."' width='100%' height='100%' src='../files/productsPhotos/".$content[6]."' /><br />
                                <div class='infoValue alert alert-success'>".$content[1]."</div></a>
                              </div>";
                    $data .= "</div>";
                    $counter = 0;
                } else {
                    $data .= "<div class='col-xs-10 col-sm-5 col-md-4 text-center'>
                                <a onclick='viewProduct(".$content[0].")'><img class='img-responsive' alt='".$content[1]."' width='100%' height='100%' src='../files/productsPhotos/".$content[6]."' /><br />
                                <div class='infoValue alert alert-success'>".$content[1]."</div></a>
                              </div>";
                }
                $counter++;

            }
            echo $data;
            $this->closeConnection();
        }
        /*
        function addOrder($packageId, $userID, $paymentMethod, $whereToDeliver) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("INSERT INTO orders VALUES (null, ?, ?, ?, ?, ?, 0);");
            $sql->execute(array($this->getCurrentDate(), $packageId, $userID, $paymentMethod, $whereToDeliver));

            $this->closeConnection();
        }
        */
        function viewProduct($id) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("SELECT * FROM products WHERE prodId = ?;");
            $sql->execute(array($id));

            $data = "";
            while($content = $sql->fetch()) {
                if(isset($_SESSION["currentUserID"])) {
                    $data .= "<div id='viewProductDataDiv'><h4 class='alert alert-info' style='text-align: left;'>Product Name: <label>".$content[1]."</label><a class='btn btn-info pull-right' href='index.php'><span class='glyphicon glyphicon-chevron-left'></span>BACK</a></h4>";
                    $data .= "<br/><div class='btn btn-info col-lg-12 alert alert-success' onclick="."addToCart('prod".$id."')"."><label>CLICK HERE TO ADD THIS PRODUCT TO YOU CART  <span class='glyphicon glyphicon-shopping-my-cart'></span></label></div><br />";

                    $data .= "<div class='row text-center'>
                                  <div class='col-md-6'>".
                                    "<img style='margin: auto; text-align: center;' class='img-responsive' src='../files/productsPhotos/".$content[6]."' />
                                  </div>
                                  <div class='col-md-6'>
                                    <p class='alert alert-success' style='text-align: left; height: 100%;'><label>Description:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>".$content[2]."<br />
                                    <label>Price:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>".$content[3]."</p>
                                  </div>
                              </div><br />
                              <div class='btn btn-info col-lg-12 alert alert-success' onclick="."addToCart('prod".$id."')"."><label>CLICK HERE TO ADD THIS PRODUCT TO YOU CART  <span class='glyphicon glyphicon-shopping-my-cart'></span></label></div><br/>
                              </div>";

                } else {
                    $data .= "<div id='viewProductDataDiv'><h4 class='alert alert-info' style='text-align: left;'>Product Name: <label>".$content[1]."</label><a class='btn btn-info pull-right' href='index.php'><span class='glyphicon glyphicon-chevron-left'></span>BACK</a></h4>";
                    $data .= "<p class='alert alert-danger'>Please <a href='../login'><label>log-in or create your account</label></a> and avail this product now.</p>";

                    $data .= "<img class='img-responsive' style='margin: auto; text-align: center;' src='../files/productsPhotos/".$content[6]."' /><br />
                          <p class='alert alert-info' style='text-align: left;'><label>Description:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>".$content[2]."<br />
                          <label>Price:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>".$content[3]."</p>
                          <p class='alert alert-danger'>Please <a href='../login'><label>log-in or create your account</label></a> and avail this product now.</p>
                          </div>";
                }
            }

            echo $data;

            $this->closeConnection();
        }

        function addToCart($prodId, $quantity, $category) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("INSERT INTO tempOrders VALUES (null, ?, ?, ?, ?, ?);");
            $sql->execute(array($_SESSION["currentUserID"], $prodId, $quantity, $this->getCurrentDate(), $category));

            $this->closeConnection();
        }

        function viewCart() {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("SELECT t.tempId, p.name, p.sellingPrice, t.quantity, t.dateAdded FROM products p, users u, tempOrders t WHERE p.prodId = t.prodId AND u.user_Id = t.userId AND t.userId = ? AND t.category='product';");
            $sql->execute(array($_SESSION["currentUserID"]));

            $data = "";
            $totalAmount = 0;
            while($content = $sql->fetch()) {
                $data .= "<tr id='temp".$content[0]."'>
                            <td>
                                <a onclick='removeProductFromCart(".$content[0].")' title='Remove ".$content[1]." from my-cart'><span class='glyphicon glyphicon-remove'></span></a>&nbsp;&nbsp;&nbsp;
                                <a onclick='editQuantityOfProductFromCart(".$content[0].")' title='Edit quantity for ".$content[1]."'><span class='glyphicon glyphicon-pencil'></span></a>
                            </td>
                            <td id='tempOrderName".$content[0]."'>".$content[1]."</td>
                            <td id='tempOrderPrice".$content[0]."'>".$content[2]."</td>
                            <td id='tempOrderQuantity".$content[0]."'>".$content[3]."</td>
                            <td id='tempOrderSubtotal".$content[0]."'>".($content[2]*$content[3])."</td>
                            <td>".$content[4]."</td>
                          </tr>";
                $totalAmount += ($content[2]*$content[3]);
            }
                //==== for packages
            $sql2 = $this->dbHolder->prepare("SELECT t.tempId, p.name, p.price, t.quantity, t.dateAdded FROM packages p, users u, tempOrders t WHERE p.packageId = t.prodId AND u.user_Id = t.userId AND t.userId = ? AND t.category='package';");
            $sql2->execute(array($_SESSION["currentUserID"]));

            while($content2 = $sql2->fetch()) {
                $data .= "<tr id='temp".$content2[0]."'>
                            <td>
                                <a onclick='removeProductFromCart(".$content2[0].")' title='Remove ".$content2[1]." from my-cart'><span class='glyphicon glyphicon-remove'></span></a>&nbsp;&nbsp;&nbsp;
                                <a onclick='editQuantityOfProductFromCart(".$content2[0].")' title='Edit quantity for ".$content2[1]."'><span class='glyphicon glyphicon-pencil'></span></a>
                            </td>
                            <td id='tempOrderName".$content2[0]."'>".$content2[1]."</td>
                            <td id='tempOrderPrice".$content2[0]."'>".$content2[2]."</td>
                            <td id='tempOrderQuantity".$content2[0]."'>".$content2[3]."</td>
                            <td id='tempOrderSubtotal".$content2[0]."'>".($content2[2]*$content2[3])."</td>
                            <td>".$content2[4]."</td>
                          </tr>";
                $totalAmount += ($content2[2]*$content2[3]);
            }

            if($data != "") {
                $data .= " <tr class='alert alert-info'><th colspan='5'>Total Amount:</th><td id='tempOrderTotalAmount'>".$totalAmount.".00</td></tr>";
                $data = "<tr>
                            <th>Action</th>
                            <th>Product | Package</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Sub-Total</th>
                            <th>Date Added</th>
                         </tr>".$data;
                $data = "<button class='btn btn-info alert alert-success col-lg-12' onclick='showSubmitOrdersDialog()'><label>CLICK HERE TO SUBMIT ORDERS</label></button>
                <div class='pull-right'><a href='../products'>There are other products I want to order.</a></div>
                <table id='tblTempOrders' class='table table-hover'>".$data."</table>
                <button class='btn btn-info alert alert-success col-lg-12' onclick='showSubmitOrdersDialog()'><label>CLICK HERE TO SUBMIT ORDERS</label></button>";
            } else {
                $data = "<h6 class='alert alert-danger'>Your cart is empty. <a href='../products'>CLICK HERE</a> to Order now!</h6>";
            }

            echo $data;

            $this->closeConnection();
        }

        function removeProductFromCart($tempOrderID) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("DELETE FROM tempOrders WHERE tempID = ?;");
            $sql->execute(array($tempOrderID));

            $this->closeConnection();
        }

        function editQuantityOfProductFromCart($tempOrderID, $newQuantity) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("UPDATE tempOrders set quantity = ? WHERE tempID = ?;");
            $sql->execute(array($newQuantity, $tempOrderID));
            echo $tempOrderID;
            $this->closeConnection();
        }

        function submitOrders($method, $receiver, $address, $careOf, $number, $paymentMethod, $dateOfPickUp) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("INSERT INTO transactions VALUES (null, ?, ?, 0, ?);");
            $sql->execute(array($_SESSION["currentUserID"], $this->getCurrentDate(), $method));
            $id = $this->dbHolder->lastInsertId();

            $sql1 = $this->dbHolder->prepare("SELECT t.*, p.name FROM tempOrders t, products p WHERE p.prodId = t.prodId AND t.userId = ?;");
            $sql1->execute(array($_SESSION["currentUserID"]));

            $ordersOfClient = "";

            while($content = $sql1->fetch()) {
                $sql2 = $this->dbHolder->prepare("INSERT INTO orderedItems VALUES (null, ?, ?, ?, ?);");
                $sql2->execute(array($id, $content[5], $content[2], $content[3]));

                $ordersOfClient .= ($content[6]." - ".$content[3]."; ");
            }

            if($method == "delivery" OR $method == "ship") {
                $sql3 = $this->dbHolder->prepare("INSERT INTO orderInformation VALUES (null, ?, ?, ?, ?, ?, ?, null);");
                $sql3->execute(array($id, $address, $receiver, $careOf, $number, $paymentMethod));
            } else {
                $sql3 = $this->dbHolder->prepare("INSERT INTO orderInformation VALUES (null, ?, ?, ?, null, ?, ?, ?);");
                $sql3->execute(array($id, $address, $receiver, $number, $paymentMethod, $dateOfPickUp));
            }

            $sql4 = $this->dbHolder->prepare("DELETE FROM tempOrders WHERE userId = ?;");
            $sql4->execute(array($_SESSION["currentUserID"]));

            echo $ordersOfClient;

            $this->closeConnection();
        }

        function displayClientTransactionsToClient() {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("SELECT t.transId, t.dateOfTransaction, t.status
                                             FROM users u, transactions t
                                             WHERE u.user_id = t.userId AND u.user_id = ?
                                             ORDER BY t.status, t.dateOfTransaction DESC;");
            $sql->execute(array($_SESSION["currentUserID"]));
            $data = "";
            while($content = $sql->fetch()) {
                $sql1 = $this->dbHolder->prepare("SELECT p.name
                                                  FROM products p, orderedItems o
                                                  WHERE p.prodId = o.itemId AND o.category='product' AND o.transID = ?;");
                $sql1->execute(array($content[0]));
                $orderedItems = "";
                $counter = 0;
                while($oI = $sql1->fetch() AND $counter < 3) {
                    $orderedItems .= ($oI[0]."<br />");
                    $counter++;
                    if($counter == 3) $orderedItems .= "...";
                }

                if($counter == 0) {
                    $sql1 = $this->dbHolder->prepare("SELECT p.name
                                                  FROM products p, orderedItems o
                                                  WHERE p.prodId = o.itemId AND o.category='product' AND o.transID = ?;");
                    $sql1->execute(array($content[0]));
                    $orderedItems = "";
                    $counter = 0;
                    while($oI = $sql1->fetch() AND $counter < 3) {
                        $orderedItems .= ($oI[0]."<br />");
                        $counter++;
                        if($counter == 3) $orderedItems .= "...";
                    }

                }

                if($content[2] == 1) $status = "<span style='color: green;'><span class='glyphicon glyphicon-check'></span> RECEIVED</span>";
                else $status = "<span style='color: red;'>ON PROCESS</span>";

                $sql2 = $this->dbHolder->prepare("SELECT * FROM payments WHERE transID = ?;");
                $sql2->execute(array($content[0]));
                $payment = "<label style='color: RED;'>UNPAID</label><br /><a onclick='attachProofOfPayment(".$content[0].")'>Click HERE to Attach Proof Payment</a>";
                if($payInfo = $sql2->fetch()) {
                    if($payInfo[6] == 0) $payment = "<label style='color: orange;'>PAID (to be verified)</label>";
                    else $payment = "<label style='color: green'>PAID</label>";
                }

                $data .= "<tr>
                            <td>".$content[0]."</td>
                            <td>".$content[1]."</td>
                            <td>".$orderedItems."</td>
                            <td>".$payment."</td>
                            <td>".$status."</td>
                            <td><a onclick='showTransCompleteDetailsToClient(".$content[0].")'>show complete details</a></td>
                          </tr>";
            }

            if($data != "") {
                $data .= "<h4 class='alert alert-info'>Recent Transactions";
                $data .= "<div class='pull-right'>
                            <span class='input-group input-group-lg'>
                            <select class='input-sm'>
                                <option>Date</option>
                                <option>Orders</option>
                            </select>

                                <input type='text' class='input-sm' placeholder='search transaction'><button class='btn-sm'><span class='glyphicon glyphicon-search'></span></button>
                            </span>
                          </div></h4>";
                $data = "<table class='table table-responsive'>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Ordered Items</th>
                                <th>Payment Status</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                            ".$data."
                         </table>";
                echo $data;
            } else {

            }

            $this->closeConnection();
        }

        function attachProofOfPayment($transID, $photo, $desc) {
            $this->openConnection();

            $sql = $this->dbHolder->prepare("INSERT INTO payments VALUES (null, ?, ?, ?, ?, ?, ?);");
            $sql->execute(array($transID, $_SESSION["currentUserID"], $photo, $desc, $this->getCurrentDate(), 0 ));

            $this->closeConnection();
        }

        function getCurrentDate() {;

            $sql = $this->dbHolder->query("SELECT CURDATE();");
            $data = $sql->fetch();

            return $data[0];

        }
    }