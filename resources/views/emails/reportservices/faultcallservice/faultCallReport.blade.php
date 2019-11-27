<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Fault Call Report</title>
</head>
<body>

<style>
	@import "https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700";html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,total,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}table{border-collapse:collapse;border-spacing:0}body{height:840px;width:592px;margin:auto;font-family:'Open Sans',sans-serif;font-size:12px}strong{font-weight:700}#container{position:relative;padding:4%}#header{height:80px}#header > #reference{float:right;text-align:right}#header > #reference h3{margin:0}#header > #reference h4{margin:0;font-size:85%;font-weight:600}#header > #reference p{margin:0;margin-top:2%;font-size:85%}#header > #logo{width:50%;float:left}#fromto{height:160px}#fromto > #from,#fromto > #to{width:45%;min-height:90px;margin-top:30px;font-size:85%;padding:1.5%;line-height:120%}#fromto > #from{float:left;width:45%;background:#efefef;margin-top:30px;font-size:85%;padding:1.5%}#fromto > #to{float:right;border:solid grey 1px}#items{margin-top:10px}#items > p{font-weight:700;text-align:right;margin-bottom:1%;font-size:65%}#items > table{width:100%;font-size:85%;border:solid grey 1px}#items > table th:first-child{text-align:left}#items > table th{font-weight:400;padding:1px 4px}#items > table td{padding:1px 4px}#items > table th:nth-child(2),#items > table th:nth-child(4){width:45px}#items > table th:nth-child(3){width:60px}#items > table th:nth-child(5){width:80px}#items > table tr td:not(:first-child){text-align:right;padding-right:1%}#items table td{border-right:solid grey 1px}#items table tr td{padding-top:3px;padding-bottom:3px;height:10px}#items table tr:nth-child(1){border:solid grey 1px}#items table tr th{border-right:solid grey 1px;padding:3px}#items table tr:nth-child(2) > td{padding-top:8px}#summary{height:170px;margin-top:30px}#summary #note{float:left}#summary #note h4{font-size:10px;font-weight:600;font-style:italic;margin-bottom:4px}#summary #note p{font-size:10px;font-style:italic}#summary #total table{font-size:85%;width:260px;float:right}#summary #total table td{padding:3px 4px}#summary #total table tr td:last-child{text-align:right}#summary #total table tr:nth-child(3){background:#efefef;font-weight:600}#footer{margin:auto;position:absolute;left:4%;bottom:4%;right:4%;border-top:solid grey 1px}#footer p{margin-top:1%;font-size:65%;line-height:140%;text-align:center}

	.page-break {
    	page-break-after: always;
	}

</style>


<div id="container">
	<div id="header">
		<div id="logo">
			<img src="https://www.irepweb.com/images/abme.png" alt="" width="230px" height="70px">
		</div>
		<div id="reference">
			<h3><strong>FAULT CALL REPORT</strong></h3>
			<h4>Ref. : {{ $data['report_id'] }}</h4>
			<p>Date  : {{ $data['fault_call_receive_date'] }} </p>
		</div>
	</div>
	<br><br>
	<div id="fromto">
        <div id="from">
			<p>
				<strong>Submit To</strong><br>
				{{ $data['contact_person'] }} <br><br>
                <strong>Submit Date</strong><br>
				{{ $data['fault_call_receive_date'] }} <br><br>
                <strong>Status</strong><br>
				{{ $data['status'] }} <br><br>
			</p>
		</div>
		<div id="to">
			<p>
				Visiting Date: {{ $data['arrival_date'] }} <br>
                Visiting Time: {{ $data['arrival_time'] }} <br>
                Location: {{ $data['station_id'] }} <br><br>
			</p>
		</div>
	</div>
	<br><br><br>
	<div id="items">
		<p>Fault Call</p>
		<table>
			<tr>
				<td>Reason</td>
				<td>{{ $data['fault_alarm_inspection_reason'] }}</td>
			</tr>
			<tr>
				<td>Description</td>
				<td>{{ $data['fault_alarm_inspection_desc'] }}</td>
			</tr>

		</table>
	</div>
	<br><br>
	<div id="footer">
		<p>abme.com.sg <br>
			Fault Call Report. Ref: {{ $data['report_id'] }}</p>
	</div>
	<div class="page-break"></div>
	<div id="summary">
		<div id="note">
			<h4>Remarks :</h4>
			<p>Null</p>
		</div>
		<div id="total">
			<table border="1">
				<tr>
					<td>Report By</td>
					<td>{{ $data['inspection_conducted_by_name'] }}</td>
				</tr>
                <tr>
					<td>Signature</td>
                    <td></td>
				</tr>
                <tr>
                    <td colspan="2">
                        <img src="{{ $data['inspection_conducted_by_signature'] }}" alt="" width="100px" height=" 80px">
                    </td>
                </tr>
			</table>


		</div>
	</div>

	@if ($data['witness_by_abme_name'] !== null)
    <div id="summary">
		<div id="total">
			<table border="1">
				<tr>
					<td>Report By</td>
					<td>{{ $data['witness_by_abme_name'] }}</td>
				</tr>
				<tr>
                    <td>Signature</td>
                    <td></td>
				</tr>
                <tr>
                    <td colspan="2">

                    </td>
                </tr>
			</table>


		</div>
	</div>
	@endif
	{{-- @if ($data['witness_by_sbst_name'] !== null)
    <div id="summary">
		<div id="total">
			<table border="1">
				<tr>
					<td>Report By</td>
					<td>{{ $data['witness_by_sbst_name'] }}</td>
				</tr>
				<tr>
                    <td>Signature</td>
                    <td>{{ $data['report_by_name_3_date'] }}</td>
				</tr>
                <tr>
                    <td colspan="2">
                        @if ($data['witness_by_sbst_signature'] !== null)
                        <img src="{{ $data['witness_by_sbst_signature'] }}" alt="" width="100px" height=" 80px">
                        @endif
                    </td>
                </tr>
			</table>


		</div>
	</div>
	@endif--}}

	<div id="footer">
		<p>abme.com.sg <br>
			Field Visit Report. Ref: {{ $data['report_id'] }}</p>
	</div>
</div>

</body>
</html>
