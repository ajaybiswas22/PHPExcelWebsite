<?php 
include_once 'phpindex/index_login_status.php';
include_once 'dependencies/companyname.php';
echo <<<HTML
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="">$company</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <!--Delete the two below, dont delete the next comment -->
        <li><a href="ComputerScience/computerscience.php">Computer Science</a></li>
        <li><a href="ComputerScience/questionpapers.php">Question Papers</a></li>
				<!--titlebarlinks-->
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <form class="navbar-form navbar-left" action="search/search_result.php"  method="get">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="search_query">
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit">
            <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
      </div>
    </form>
        <li><a href="$Login_link"><span class="glyphicon glyphicon-log-in"></span> $Login_name</a></li>
      </ul>
    </div>
  </div>
</nav>
HTML;
?> 

