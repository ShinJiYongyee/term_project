<!DOCTYPE html>
<html lang="ko">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>새 프로젝트 정보 입력</title>
</head>
<body>

<h1>새 프로젝트 정보 입력</h1>
<form method="post" action="insert_result.php">
    프로젝트명: <input type="text" name="projectname" required> <br>
    정보: <input type="text" name="intel" required> <br>
    단계:
    <select name="phase" required>
        <option value="절차확립">절차확립</option>
        <option value="예산확보">예산확보</option>
        <option value="공정확보">공정확보</option>
        <option value="원자재준비">원자재준비</option>
        <option value="공정가동">공정가동</option>
        <option value="홍보">홍보</option>
        <option value="상품출시">상품출시</option>
        <option value="진행">진행</option>
        <option value="중간평가">중간평가</option>
        <option value="계획수정">계획수정</option>
        <option value="종결평가">종결평가</option>
        <option value="프로젝트종결">프로젝트종결</option>
    </select>
    <br>
    직원: <input type="text" name="employee" required> <br>
    날짜: <input type="date" name="deadline" required> <br><br>
    <input type="submit" value="정보 입력">
</form>

</body>
</html>
