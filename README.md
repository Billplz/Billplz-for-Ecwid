# Billplz for Ecwid

* Accept Payment using Billplz for Ecwid
* Last Update: 18 June 2017

# Minimum System Requirements

* PHP 5.6 or newer
* Linux or Windows-Based Hosting/Server
* MySQL 5.5 Database

# Installation

1. Download this repository
2. Create database and import **db.sql**
3. Configure **config.php**. Make sure website URL is end with thrailing slash **"/"**
4. Done!

* **Note: You can use the ready-made system at: https://www.wanzul.net/billplz/ecwid**

# The Payment Flow

1. Buyer will make an order on merchant Ecwid site.
2. Buyer will be redirected to the system.
3. The system will redirect the user to the Billplz Payment Page
4. After completing payment, the user will be redirected back to The system.
5. Th system will redirect the user back to the merchant Ecwid site

Behind the scene: The system will send callback signal to the merchant Ecwid site

# How to configure?

1. Access to the installated system folder. <br>
1.1 or: https://www.wanzul.net/billplz/ecwid
2. Input the required details (**API Secret Key, X Signature Key & Collection ID**)
3. Take note the **API Login ID, Transaction Key, MD5 Hash Value, Transaction Type & Endpoint URL**
4. Login to http://www.ecwid.com >> Settings >> Payment >> See Complete List >> Authorize.net SIM
5. Click on the Account Settings
6. Key in the information the have been noted on step (3)
7. Save

# Needs customization?

You can edit specific file according to the categorized pattern. 

  * Controller: Defines the logic
  * Models Defines the sql query to MySQL
  * Views: Output to the end user, JavaScript, and Styling
  * Includes: Defines all required files

# Other

Please open an issue or email to wan@wanzul-hosting.com
