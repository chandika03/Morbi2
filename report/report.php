<!DOCTYPE html>
<html>
  <head>
    <title>report</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
      body {
        background-color: #fff;
        color: #9a208c;
        font-family: Arial, sans-serif;
        padding: 8rem 32rem;
      }

      #report {
        background-color: #f5c6ec;
        padding: 20px;
        border-radius: 5px;
        width: 25rem;
      }

      h3 {
        color: #e11299;
        text-align: center;
      }

      form {
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .number {
        padding: 20px;
        width: 300px;
        height: 10px;
        margin: 0 2rem 0 7px;
      }

      #reason {
        width: 300px;
        height: 200px;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #9a208c;
        border-radius: 5px;
      }
      .report-id {
        width: 100%;
        height: 15px;
      }

      input[type="submit"] {
        background-color: #9a208c;
        color: #fff;
        border: none;
        padding: 15px 25px;
        border-radius: 5px;
        cursor: pointer;
      }

      input[type="submit"]:hover {
        background-color: #e11299;
      }
    </style>
  </head>
  <body>
    <div id="report">
      <h3>Why are you reporting this user?</h3>

      <form action="reportdb.php" method="POST">
        <div class="number">
          <input
            placeholder="user-id"
            class="report-id"
            type="text"
            name="userId"
            value="<?php echo $_GET['userId'] ?>"
            readonly
          />
        </div>
        <textarea
          id="reason"
          name="reason"
          placeholder="Enter your reasons here"
          required
        ></textarea
        ><br /><br />
        <input type="submit" value="Submit" />
      </form>
    </div>
    <script src="script.js"></script>
  </body>
</html>
