<div class="inline" id="right_col">
<div class="block" style="width:650px">
<h1>اتصل بنا</h1>



<? if(isset($this->success)) { echo $this->success;} else { ?>
<p>
جميع الاسئلة و التعليقات مرحب بها
</p>
<br>
<form action="<?=DOMAIN."home/contact/";?>" id="fscf_form1" method="post">
<div id="fscf_required1"> <span style="text-align:right;">*</span> 
<span style="text-align:right;">حقل مطلوب</span></div>
<div id="fscf_div_clear1_0" style="clear:both;">
<div id="fscf_div_field1_0" style="clear:right; float:right; width:99%; max-width:550px; margin-right:10px;">
<div style="text-align:right; padding-top:5px;"> <label style="text-align:right;" for="fscf_name1">الاسم:<span style="text-align:right;">*</span></label></div>
<div style="text-align:right;"> 
<input style="text-align:right; margin:0; width:99%; max-width:250px;" type="text" id="fscf_name1" name="name" value="<?=$this->name;?>"></div></div></div>
<div id="fscf_div_clear1_1" style="clear:both;"><div id="fscf_div_field1_1" style="clear:right; float:right; width:99%; max-width:550px; margin-right:10px;"><div style="text-align:right; padding-top:5px;"> 
<label style="text-align:right;" for="fscf_email1">البريد الاكتروني:<span style="text-align:right;">*</span></label></div>
<div style="text-align:right;"> 
<input style="text-align:right; margin:0; width:99%; max-width:250px;" type="text" id="fscf_email1" name="address" value="<?=$this->email;?>"></div></div></div>
<div id="fscf_div_clear1_2" style="clear:both;"><div id="fscf_div_field1_2" style="clear:right; float:right; width:99%; max-width:550px; margin-right:10px;"><div style="text-align:right; padding-top:5px;"> <label style="text-align:right;" for="fscf_field1_2">الموضوع:<span style="text-align:right;">*</span></label></div>
<div style="text-align:right;"> 
<input style="text-align:right; margin:0; width:99%; max-width:250px;" type="text" id="fscf_field1_2" name="subject" value="<?=$this->subject;?>"></div></div></div>
<div id="fscf_div_clear1_3" style="clear:both;"><div id="fscf_div_field1_3" style="clear:right; float:right; width:99%; max-width:550px; margin-right:10px;">
<div style="text-align:right; padding-top:5px;"> 
<label style="text-align:right;" for="fscf_field1_3">الرسالة:<span style="text-align:right;">*</span></label></div>
<div style="text-align:right;"><textarea style="text-align: right; margin: 0px; width: 309px; max-width: 250px; height: 120px;" id="fscf_field1_3" name="message" cols="30" rows="10"><?=$this->message;?></textarea></div></div></div>
<div style="clear:both;"></div><div style="text-align:right; padding-top:5px;"></div>
<input type="submit" name ="submit" value="submit"/>
</form>
<? if(isset($this->error)) { ?> <b style="color:red";><? echo $this->error;?></b><? } ?>
<? } ?>
</div>
</div>
</div>	