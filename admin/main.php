
<div id="configbox" class="py-3 px-4">

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="replace" />

		<h3>문자 치환하기</h3>

		<p class="text-muted f13">
			로컬서버에서 작업하고 온라인서버에 업로드하는 경우가 있습니다.<br>
			이 경우 이미 등록된 게시물이나 댓글에 삽입된 미디어파일의 주소를 온라인주소로
			변경해야 하는 경우가 있습니다.<br>
			DB내에서 특정문자열을 변경하고자 할때 사용하십시오.
		</p>

		<nav class="mt-4">
		  <div class="nav nav-tabs" id="nav-tab" role="tablist">
		    <a class="nav-item nav-link active" data-toggle="tab" href="#pan-basic" role="tab" aria-controls="pan-basic" aria-selected="true">기본</a>
		    <a class="nav-item nav-link" data-toggle="tab" href="#pan-advan" role="tab" aria-controls="pan-advan" aria-selected="false">고급</a>
		  </div>
		</nav>
		<div class="tab-content mt-4">
		  <div class="tab-pane show active" id="pan-basic" role="tabpanel">
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="checkbox" id="where_post" name="where_post" value="1"<?php if(strpos($_SESSION['db_where'],'p')):?> checked="checked"<?php endif?>>
				  <label class="form-check-label" for="where_post">포스트</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" id="where_bbs" name="where_bbs" value="1"<?php if(strpos($_SESSION['db_where'],'b')):?> checked="checked"<?php endif?>>
					<label class="form-check-label" for="where_bbs">게시판</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" id="where_comment" name="where_comment" value="1"<?php if(strpos($_SESSION['db_where'],'c')):?> checked="checked"<?php endif?>>
					<label class="form-check-label" for="where_comment">댓글</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" id="where_upload" name="where_upload" value="1"<?php if(strpos($_SESSION['db_where'],'u')):?> checked="checked"<?php endif?>>
					<label class="form-check-label" for="where_upload">첨부파일</label>
				</div>
			</div>
		  <div class="tab-pane" id="pan-advan" role="tabpanel" aria-labelledby="nav-profile-tab">

				<div class="form-group row">
					<label class="col-sm-1 col-form-label text-right">테이블</label>
					<div class="col-sm-5">
						<input type="text" name="table_name" value="" class="form-control">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-1 col-form-label text-right">컬럼</label>
					<div class="col-sm-5">
						<input type="text" name="field_name" value="" class="form-control">
					</div>
				</div>

			</div>
		</div>

		<div class="row mt-5">
			<div class="col">
				<h5 class="mb-3">찾을주소</h5>
				<input type="text" name="from_str" size="60" value="<?php echo $_SESSION['db_from_str']?>" class="form-control">
			</div>
			<div class="col">
				<h5 class="mb-3">바꿀주소</h5>
				<input type="text" name="to_str" size="60" value="<?php echo $_SESSION['db_to_str']?$_SESSION['db_to_str']:$g['url_root']?>" class="form-control">
			</div>
		</div>

		<div class="my-4 text-muted f13">
			이 작업은 데이터의 양에 따라 서버에 많은 부하를 줄 수 있습니다.<br>
			꼭 필요한 경우가 아니라면 사용하지 마십시오.
		</div>

		<div class="submitbox">
			<button type="submit" class="btn btn-primary">확인</button>
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

function saveCheck(f) {

	if (chkFlag == 1) {
		if (f.table_name.value == '') {
			alert('테이블명을 입력해 주세요.  ');
			f.table_name.focus();
			return false;
		}
		if (f.field_name.value == '') {
			alert('컬럼명을 입력해 주세요.  ');
			f.field_name.focus();
			return false;
		}
	} else {
		if (f.where_bbs.checked == false && f.where_comment.checked == false && f.where_upload.checked == false) {
			alert('변경장소는 적어도 한곳이상 선택해야 합니다.');
			return false;
		}
	}
	if (f.from_str.value == '') {
		alert('찾을 주소를 입력해 주세요.   ');
		f.from_str.focus();
		return false;
	}

	if (f.to_str.value == '') {
		alert('바꿀 주소를 입력해 주세요.   ');
		f.to_str.focus();
		return false;
	}

	return confirm('정말로 실행하시겠습니까?         ');
}
//]]>
</script>
