<?php
// 세션시작 확인
require_once './indexhead.php';

?>
<style>
  .container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin: 100px;
  }

  .box {
    background-color: #fff;
    border-radius: 10px;
    padding: 10px;
    margin: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    flex-basis: calc(20% - 20px);
    text-align: center;
  }

  .text {
    color: #000;
    font-size: 15px;
    font-weight: bold;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
  }

  a {
    color: black;
    text-decoration: none;
  }
</style>

<div class="container">
  <div class="box">
    <div class="text">
      <a href="./minigame_1.html">숫자맞추기</a>
    </div>
  </div>
  <div class="box">
    <div class="text">
      텍스트 내용 2
    </div>
  </div>
  <div class="box">
    <div class="text">
      텍스트 내용 3
    </div>
  </div>
  <div class="box">
    <div class="text">
      텍스트 내용 4
    </div>
  </div>
  <div class="box">
    <div class="text">
      텍스트 내용 5
    </div>
  </div>
    <div class="box">
    <div class="text">
      텍스트 내용 4
    </div>
  </div>
</div>
