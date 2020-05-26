
<div id="configbox" class="p-3">

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $module?>" />
	<input type="hidden" name="a" value="replace" />

	<div class="title">
		문자 치환하기
	</div>


	<div class="notice">
		킴스큐RB를 로컬서버에서 작업하고 온라인서버에 업로드하는 경우가 있습니다.<br />
		이 경우 이미 등록된 게시물이나 댓글에 삽입된 미디어파일의 주소를 온라인주소로<br />
		변경해야 하는 경우가 있습니다.<br />
		DB내에서 특정문자열을 변경하고자 할때 사용하십시오.<br />
	</div>

	<table>
		<tr>
			<td class="td1">변경장소</td>
			<td class="td2 shift">

				<div id="elebox">
				<input type="checkbox" name="where_blog" value="1"<?php if(strpos($_SESSION['db_where'],'b')):?> checked="checked"<?php endif?> /> 블로그

				<input type="checkbox" name="where_bbs" value="1"<?php if(strpos($_SESSION['db_where'],'b')):?> checked="checked"<?php endif?> /> 게시판
				<input type="checkbox" name="where_comment" value="1"<?php if(strpos($_SESSION['db_where'],'c')):?> checked="checked"<?php endif?> /> 댓글
				<input type="checkbox" name="where_upload" value="1"<?php if(strpos($_SESSION['db_where'],'u')):?> checked="checked"<?php endif?> /> 첨부파일
				<span class="btn btn-default btn-sm" onclick="checkFlag(1);">고급</span>
				</div>
				<div id="extbox" class="">
				테이블 : <input type="text" name="table_name" value="" class="input" />
				컬럼 : <input type="text" name="field_name" value="" class="input" />
				<span class="btn btn-default btn-sm" onclick="checkFlag(2);">기본</span>
				</div>
			</td>
		</tr>
		<tr>
			<td class="td1">찾을주소</td>
			<td class="td2">
				<input type="text" name="from_str" size="60" value="<?php echo $_SESSION['db_from_str']?>" class="input" />
			</td>
		</tr>
		<tr>
			<td class="td1">바꿀주소</td>
			<td class="td2">
				<input type="text" name="to_str" size="60" value="<?php echo $_SESSION['db_to_str']?$_SESSION['db_to_str']:$g['url_root']?>" class="input" />
			</td>
		</tr>
		<tr>
			<td class="td1"></td>
			<td class="td2">
				<div class="guide">
				이 작업은 데이터의 양에 따라 서버에 많은 부하를 줄 수 있습니다.<br />
				꼭 필요한 경우가 아니라면 사용하지 마십시오.
				</div>
			</td>
		</tr>
	</table>



	<div class="submitbox">
		<input type="submit" class="btnblue" value=" 확인 " />
	</div>

	</form>

</div>




<script type="text/javascript">
//<![CDATA[
var chkFlag = 2;
function checkFlag(n)
{
	var f = document.procForm;
	if (n == 1)
	{
		getId('elebox').style.display = 'none';
		getId('extbox').style.display = 'block';
		f.where_bbs.checked = false;
		f.where_comment.checked = false;
		f.where_upload.checked = false;
		f.table_name.focus();
		chkFlag = 1;
	}
	else {
		getId('elebox').style.display = 'block';
		getId('extbox').style.display = 'none';
		chkFlag = 2;
	}
}
function saveCheck(f)
{

	if (chkFlag == 1)
	{
		if (f.table_name.value == '')
		{
			alert('테이블명을 입력해 주세요.  ');
			f.table_name.focus();
			return false;
		}
		if (f.field_name.value == '')
		{
			alert('컬럼명을 입력해 주세요.  ');
			f.field_name.focus();
			return false;
		}
	}
	else {
		if (f.where_bbs.checked == false && f.where_comment.checked == false && f.where_upload.checked == false)
		{
			alert('변경장소는 적어도 한곳이상 선택해야 합니다.');
			return false;
		}
	}
	if (f.from_str.value == '')
	{
		alert('찾을 주소를 입력해 주세요.   ');
		f.from_str.focus();
		return false;
	}
	if (f.to_str.value == '')
	{
		alert('바꿀 주소를 입력해 주세요.   ');
		f.to_str.focus();
		return false;
	}
	return confirm('정말로 실행하시겠습니까?         ');
}
//]]>
</script>
