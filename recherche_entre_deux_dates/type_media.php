<link rel="stylesheet" type="text/css" href="discussion.css">
<script type="text/javascript">

function growUp(nbimg, nb)
{

	console.log("2");
	var elements = document.querySelectorAll("growup");
	var div1 = document.getElementById(nbimg);
	var img = document.getElementById(nbimg);
	div1.classList.add("divgrow");
	if (nb == 1)
	img.classList.add('imggrow');
	if (nb == 2)
	img.classList.add('imggrow2');	
	img.classList.remove('conv_img');
	
	window.addEventListener('keydown', event =>
	{
		if (event.key == 'Escape')
		{
			div1.classList.remove('divgrow');
			if (nb == 1)
			{
				img.classList.remove('imggrow');
				console.log("cas 1");
			}
			if(nb == 2)
			{
				img.classList.remove('imggrow2');	
				console.log("cas 2");
			}
			img.classList.add('conv_img');

		}
	});
}	
</script>	
<?php

$newline = trim($ligne['media']);

if ($newline[strlen($newline)-2] == 'g')
{
	$nbimg = $nbimg + 1;
	$newname = link_to_name($ligne['media']);
	$array = getimagesize("../ressource/direct_messages_media/$newname"); 
	if ($array[0] > $array[1])
	{
		?>
		<div class="growup"><img class="conv_img" id="<?php echo $nbimg ?>"  width="auto" height="250" src="../ressource/direct_messages_media/<?php echo $newname ?>" onclick="growUp(<?php echo $nbimg ?>,1)"></div><?php
	}
	else
	{
		?>
		<div class="growup"><img class="conv_img" id="<?php echo $nbimg ?>"  width="auto" height="250" src="../ressource/direct_messages_media/<?php echo $newname ?>" onclick="growUp(<?php echo $nbimg ?>,2)"></div><?php
	}
}
if ($newline[strlen($newline)-2] == '4' )
{
	$newname = video_to_name($newline, $ligne['id3']);
	echo "$newname";?>
	<video controls width="250" src="..\ressource\direct_messages_media\<?php echo $newname?>"type="video/mp4"></video>
	<?php
}
if  ($newline[strlen($newline)-2] == '1')
{
	$newname = video_mp4_tag1($newline, $ligne['id3']);?>
	<video controls width="250" src="..\ressource\direct_messages_media\<?php echo $newname?>"type="video/mp4"></video>
	<?php
} 
	$ligne['message'] = preg_replace('/((|https:\/\/)t.co\/[^\s]+)/', '', $ligne['message']);	
?>
