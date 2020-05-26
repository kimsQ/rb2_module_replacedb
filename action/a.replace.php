<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

if ($from_str && $to_str)
{
	$db_where = '_';
		if ($where_blog == '1')
	{
		db_query("update ".$table['blogdata']." set content=REPLACE(content,'".$from_str."','".$to_str."')",$DB_CONNECT);
		$db_where .= 'b';
	}
	if ($where_bbs == '1')
	{
		db_query("update ".$table['bbsdata']." set content=REPLACE(content,'".$from_str."','".$to_str."')",$DB_CONNECT);
		$db_where .= 'b';
	}
	if ($where_comment == '1')
	{
		db_query("update ".$table['s_comment']." set content=REPLACE(content,'".$from_str."','".$to_str."')",$DB_CONNECT);
		$db_where .= 'c';
	}
	if ($where_upload == '1')
	{
		db_query("update ".$table['s_upload']." set url=REPLACE(url,'".$from_str."','".$to_str."')",$DB_CONNECT);
		$db_where .= 'u';
	}

	if ($table_name && $field_name)
	{
		db_query("update ".$table_name." set ".$field_name."=REPLACE(".$field_name.",'".$from_str."','".$to_str."')",$DB_CONNECT);
	}
	
	$_SESSION['db_where'] = $db_where;
	$_SESSION['db_from_str'] = $from_str;
	$_SESSION['db_to_str'] = $to_str;
}

getLink('reload','parent.','치환되었습니다.','');
?>