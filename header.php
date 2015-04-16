
<!-- The header for each page of the portal -->

<div class='topbar'>

		<form action="search_results.php" method='post' class='form-search span7'>

			<?php

				if(isset($_SESSION['searcherror']))
				{
					echo ("

						<input type='text' class='input-large search-query span6' id='search_bar' autofocus='autofocus' placeholder='" . $_SESSION['searcherror'] ."' name='searchbar' style='height: 27px;margin-top:5px'/>

						");

					unset($_SESSION['searcherror']);
				}
				else
				{
					echo ("

						<input type='text' class='input-large search-query span6' id='search_bar' autofocus='autofocus' placeholder='Search..' name='searchbar' style='height: 27px;margin-top:5px'/>

						");
				}
			?>
			
			<button type='submit' class='btn' style="margin-top:5px; margin-left:5px">Search</button>
			<input type='hidden' value= <?php echo curPageURL(); ?> name='currurl' />
		</form>

		<a href='logout.php'><img
			src="images/icons/logout1.png" class='topbaricon'
			onmouseover="this.src='images/icons/logout3.png';"
			onmouseout="this.src='images/icons/logout1.png';"
			title='Logout'></a>

		<a href='changePassword.php'><img
			src="images/icons/settings1.png" class='topbaricon'
			onmouseover="this.src='images/icons/settings3.png';"
			onmouseout="this.src='images/icons/settings1.png';"
			title='Settings'></a>

		<a href='profile.php?userid=<?php echo $_SESSION['userid'];?>'><p class="topbarprofiletext" title="Profile"><?php echo $_SESSION['name'];?></p></a>

		<a href='profile.php?userid=<?php echo $_SESSION['userid'];?>'><img
			src="images/icons/profile1.png" class='topbaricon'
			onmouseover="this.src='images/icons/profile3.png';"
			onmouseout="this.src='images/icons/profile1.png';"
			title='Profile'></a>

		<a href='inbox.php'><img
			src="images/icons/messages1.png" class='topbaricon'
			onmouseover="this.src='images/icons/messages3.png';"
			onmouseout="this.src='images/icons/messages1.png';"
			title='Messages'></a>

		<a href='home.php'><img
			src="images/icons/home1.png" class='topbaricon'
			onmouseover="this.src='images/icons/home3.png';"
			onmouseout="this.src='images/icons/home1.png';"
			title='Home'></a>

</div>