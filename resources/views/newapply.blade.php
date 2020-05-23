@extends ('layout')

@section('content')

<script type="text/javascript" src="{{ URL::asset('js/newapply.js') }}"></script>

<div class="container pt-3">
    <div class="card p-3 mb-3" id="ruleSection">
        <h1 class="text-center text-info">資管系教室/器材使用規定</h1>
        <p>
            <h5>
                借用教室及器材前請注意下列規定:
            </h5>
            <ol>
                <li>鑰匙不得轉借他人使用，委託他人歸還時借用人仍須對教室之狀態負責並遵守資管系教室使用規定。</li>
                <li>一筆申請單只借一個時段，欲連續借用者，請務必於「其他」欄位說明，否則一律視為逾期歸還。</li>
                <li>使用105、107、017教室上課時教室內二個門都請務必要開啟，下課時務必再次確認二個門是否都有關好。</li>
                <li>離開前務必確認教室內之 1.冷氣 2.投影機 3.電燈 4.電腦或電子講桌 5.麥克風 6.桌上之總電源 7.門窗等，是否都已關閉？</li>
                <li>在關門時，請再次確認門是否上鎖了(要鎖到底)。</li>
                <li>使用後請借用人督促同學將垃圾帶走並維持教室之整潔。</li>
                <li>夜間教室借用請於當日下午16:00~17:00於系辦申請，以鐘聲為準，逾時視為放棄借用之權利。</li>
                <li>鑰匙請於活動後1小時內歸還，逾下班時間者請於隔日9:00前歸還。</li>
                <li>借用器材時，請明確備註「活動名稱+歸還日期及時間」，若無填寫歸還日期及時間者，視為活動結束隔日早上09:00前歸還。</li>
                <li>借用器材者請務必愛惜使用並應盡妥善保管之義務。</li>
                <li>器材若損壞或遺失，借用人應負起賠償之責任。</li>
                <li>違反以上規定者，系辦有權停借教室及器材。</li>
                <li>夜間活動借用教室請於晚上10:00點前結束。 </li>
                <li>以上若有未盡事宜悉依本校及管院相關規定辦理，若發現教室或設備有異常現象，請速通知系辦(mailto:vinceku@mgt.ncu.edu.tw;
                    ncu6500@ncu.edu.tw)或分機66500，否則最後之借用人應負起相關責任。</li>
                <li>本表單蒐集之個人資料，僅限於設備、教室借用相關事宜之聯絡，非經當事人同意，絕不轉作其他用途，亦不會公布任何資訊，並遵循本校個人資料保護管理制度資料保存與安全控管辦理。</li>
            </ol>
        </p>
        <button type="button" class="btn btn-success btn-lg btn-block" id="agreeBtn">我已詳細閱讀並同意上述契約並願意遵守規定</button>
    </div>

    {!!Form::open(['action' => 'ApplyController@store']) !!}
    <div class="d-none" id="formSection">

        <div class="card p-3">

            <h2 class="text-primary">基本資料</h2>
            <div class="form-row">

                {{-- 姓名:name --}}
                <div class="form-group col-md-3">
                    <label for="name">姓名</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="必填" required>
                </div>

                {{-- 身分 --}}
                <div class="form-group col-md-3">
                    <div class="form-group">
                        <label for="identity">身分</label>
                        <select class="form-control" name="identity" id="identity">
                            <option selected="selected">學生</option>
                            <option>教職員</option>
                        </select>
                    </div>
                </div>

                {{-- 學部 --}}
                <div class="form-group col-md-3" id="degreePart">
                    <label for="degree">學部</label>
                    <select class="form-control" name="degree" id="degree">
                        <option selected="selected">大學部</option>
                        <option>碩士班</option>
                        <option>碩士在職專班</option>
                        <option>博士班</option>
                    </select>
                </div>

                {{-- 班年級 --}}
                <div class="form-group col-md-3" id="gradePart">
                    <label for="grade">年級</label>
                    <select name='grade' id="grade" class=" form-control">
                    </select>
                </div>
            </div>

            <div class="form-row">

                {{-- 分機或手機 --}}
                <div class="form-group col-md-3">
                    <label for="phone">手機</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="必填" required>
                </div>

                {{-- 抵押證件 --}}
                <div class="form-group col-md-3" id="cardPart">
                    <label for="card">抵押證件</label>
                    <select class="form-control" name="card" id="card">
                        <option selected="selected">學生證</option>
                        <option>身分證</option>
                        <option>健保卡</option>
                        <option>駕照</option>
                        <option>其他</option>
                        <option>無</option>
                    </select>
                </div>

            </div>

            <div class="form-check pt-1">

                {{-- 按鈕：是否借用教室 --}}
                <input class="form-check-input" type="checkbox" value="checked" id="wantRentChk" name="wantRentChk">
                <label class="form-check-label" for="wantRentChk">
                    是否借用教室
                </label>
            </div>
        </div>


        <div class="card p-3 mt-3 d-none" id="classroomSection">
            <h2 class="text-primary">教室選擇列表</h2>
            <div class="form-row">
                <div class="form-group col-md-3" id="classroomPart">
                    <label for="classroom">借用教室</label>
                    {!!Form::select('classroom', $classroom['options'], 0, ['class' => 'form-control']) !!}
                    {{-- <select class="form-control" name="classroom" id="classroom">
                            <option selected="selected">學生證</option>
                            <option>身分證</option>
                            <option>健保卡</option>
                            <option>駕照</option>
                            <option>其他</option>
                            <option>無</option>
                        </select> --}}
                </div>
                <div class="form-group col-md-3">
                    <label for="key_type">鑰匙種類</label>
                    <select class="form-control" name="key_type" id="key_type">
                        <option selected="selected">服務學習鑰匙</option>
                        <option>備份鑰匙</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="teacher">授課教師</label>
                    <input type="text" class="form-control" name="teacher" id="teacher">
                </div>
            </div>
        </div>


        <div class="card p-3 mt-3">
            <h2 class="text-primary">借用設備</h2>

            <div class="equipmentContainer">
                <div id="equipment">
                    <div class="d-inline-flex py-3 align-items-center">
                        <h4 id="equipmentNum" class="text-info mr-3">No.1</h4>
                        <button type="button" class="btn btn-danger btn-sm" id="dltBtn">刪除</button>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="genre[]">借用設備種類</label>
                            <select class="form-control" name="genre[]" id="genre[]">
                                <option selected="selected">鑰匙</option>
                                <option>其他</option>
                            </select>
                            {{-- {!!Form::select('equipment_type[]', $equipment_type['options'], 0, ['class' =>'form-control'])!!} --}}
                        </div>
                        <div class="form-group col-md-3">
                            <label for="item[]">借用設備名稱</label>
                            <select class="form-control" name="item[]" id="item[]">
                                <option selected="selected">鑰匙</option>
                                <option>麥克風</option>
                                <option>電池盒</option>
                            </select>
                            {{-- {!!Form::select('equipment_name[]', $equipment['options'], 0, ['class' => 'form-control'])!!} --}}
                        </div>
                        <div class="form-group col-md-3">
                            <label for="quantity[]">借用數量</label>
                            <select class="form-control" name="quantity[]" id="quantity[]">
                                <option selected="selected">1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="usage[]">用途</label>
                            <input type="text" class="form-control" name="usage[]" id="usage[]" placeholder="必填"
                                required>
                        </div>
                        <div class="form-group col-md-3">
                            @php
                            $dateTime = new DateTime('tomorrow');
                            $dateTime->setTime(9, 0);
                            $returnTime = $dateTime->format('Y年m月d日 H時');
                            @endphp
                            <label for="return_time[]">歸還時間</label>
                            <input type="text" class="form-control" name="return_time[]" id="return_time[]"
                                value="{{ $returnTime }}" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="remark[]">備註</label>
                            <input type="text" class="form-control" name="remark[]" id="remark[]">
                        </div>
                    </div>
                    <hr>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <button type="button" class="btn btn-success" id="moreBtn" name="moreBtn">借用更多</button>
                </div>
            </div>
        </div>

        <div class="card border-0 my-3">
            {!!Form::submit('送出', ['class' =>'form-control btn btn-warning']) !!}
        </div>

    </div>
    {!!Form::close() !!}

</div>
@endsection