<?php
/*
 *      administrator_area.php
 *      
 *      Copyright 2012 metamorph <metamorph@metamorph>
 *      
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 *      
 *      
 */

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Administrator Area</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.20" />
	<base href="<?php echo base_url();?>" />
	<link type="text/css" href="<?php echo base_url();?>assets/menu/menu.css" rel="stylesheet" />
	<!-- set javascript base url -->
	<script type="text/javascript">
		<![CDATA[
		var base_url = '<?php echo base_url();?>';
		]]>
	</script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/menu/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/menu/menu.js"></script>
	<style type="text/css">
		body {
		 margin: -20px 10px;
		 font-family: Lucida Grande, Verdana, Sans-serif;
		 font-size: 14px;
		 color: #4F5155;
		}

		div#menu { margin:20px auto; }

		a {
		 color: #003399;
		 background-color: transparent;
		 font-weight: normal;
		}

		h1 {
		 color: #444;
		 background-color: transparent;
		 border-bottom: 1px solid #D0D0D0;
		 font-size: 16px;
		 font-weight: bold;
		 margin: 24px 0 2px 0;
		 padding: 5px 0 6px 0;
		}

		code {
		 font-family: Monaco, Verdana, Sans-serif;
		 font-size: 12px;
		 background-color: #f9f9f9;
		 border: 1px solid #D0D0D0;
		 color: #002166;
		 display: block;
		 margin: 14px 0 14px 0;
		 padding: 12px 10px 12px 10px;
		}
	</style>
</head>

<body>
	<?php
		// echo base_url();
		echo $this->dynamic_menu->build_menu('1');
	?>
</body>

</html>
