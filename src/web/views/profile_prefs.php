﻿<?
session_start();

/*
 * @author Coral Peterson
 */

set_include_path(get_include_path() . PATH_SEPARATOR . '../');



// File should never be requested directly
if (basename(getcwd()) == basename(dirname(__FILE__)))
{
	include('404.shtml');
	die();
}

//-----------------------------------------------------------------------------
// Functions
//-----------------------------------------------------------------------------

function page_body($data = null)
{


	//print_r($data['categories']);

	if (isset($data)) {
	?>
		
		
		<div id="add_category">
			<a href="#" id="add_category_link" class="button dropDown" onclick="toggle_add_category();">
				► ▼ Add New Category
			</a>			
			
			<div id="addCategoryDetails" class="dropDownDetails hidden">
				Category: <!--<input name="category" type="text" /> <br /> -->
				<select name="category">
				<?php
					$categories = $data['categories'];
					foreach ($categories as $cat) {
					?>
						<option value="<?= $cat['cat_id'] ?>"><?= $cat['name'] ?></option>
					<?php
					}		
				?>
				</select> <br />
			  
			  
				Rating: 
				<input type="radio" name="rating" value="1" /> 1
				<input type="radio" name="rating" value="2" /> 2
				<input type="radio" name="rating" value="3" /> 3
				<input type="radio" name="rating" value="4" /> 4
				<input type="radio" name="rating" value="5" /> 5
				<br />
				<a href="#" class="button submit" onclick="add_category();">Add or Update</a>
				
				
				<div class="clear"></div>
				
			</div>
			
		</div>
		
		
		
		
		

		<h2>Categories:</h2>
		<table cellpadding="0" cellspacing="0" id="preference_table">
			<tr>
				<th><div class="corner left"></div></th>
				<th class="top">Food Type</th>
				<th class="top">Rating</th>
				<th><div class="corner right"></div></th>
			</tr>
			<?php    

			//print_r($data);
			$user_prefs = $data['user_prefs'];
			$even = true;
			foreach ($user_prefs as $pref) {
			?>
				<tr id="pref_<?= $pref['name'] ?>" class="<?= $even ? 'even' : 'odd' ?>">
					<td></td>
					<td class="cat_name"><?= $pref['name'] ?></td>
					<td class="rating"><?= $pref['rating'] ?></td>
					<td></td>
				</tr>
			<?php
				$even = !$even;
			}
			?>
			
			<tr class="bottom">
				<td></td>
				<td></td>
				<td><div></div></td>
				<td></td>
			</tr>
			
		</table>
		<!--<a href="profile.php" class="button navBtn">Back</a>-->
		<?php


	} else {
	?>
    <p>No preferences set!</p>
	<?php
	}
}