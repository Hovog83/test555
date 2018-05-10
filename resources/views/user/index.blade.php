@extends('user.layout.main')
@section('content')
<!-- Masthead -->

<!-- End of masthead -->
<br>
<!-- Board info bar -->
<section class="board-info-bar">

	<div class="board-controls">
		<div class="board-title btn">
			<h2>Task list</h2>
		</div>
	</div>
</section>
<!-- End of board info bar -->
<!-- Lists container -->
<section class="lists-container">

	<div class="list">
		<h3 class="list-title">Tasks to Do </h3>
		<ul class="list-items"  id="ACTIVE">
		@if(isset($user_task['active']))
		@foreach($user_task['active'] as $asd => $val)
			<li data-title="{{$val['title']}}" data-id="{{$val['id']}}" 
			data-end_date="{{$val['end_date']}}" data-description="{{$val['description']}}" data-status="{{$val['status']}}" data-start_date="{{$val['start_date']}}"
			 id="list_{{ $val['id'] }}">{{ $val['title'] }}</li>
		@endforeach
		@endif		

		</ul>
	</div>
	<div class="list">
		<h3 class="list-title">Test </h3>
		<ul class="list-items"  id="TEST">
		@if(isset($user_task['test']))
			@foreach($user_task['test'] as $asd => $val)
				<li data-title="{{$val['title']}}" data-id="{{$val['id']}}" 
				data-end_date="{{$val['end_date']}}" data-description="{{$val['description']}}" data-status="{{$val['status']}}" data-start_date="{{$val['start_date']}}"
				 id="list_{{ $val['id'] }}">{{ $val['title'] }}</li>
			@endforeach
		@endif		
		</ul>
	</div>
	<div class="list">
		<h3 class="list-title">BUG </h3>
		<ul class="list-items"  id="BUG">
		@if(isset($user_task['bug']))
			@foreach($user_task['bug'] as $asd => $val)
				<li data-title="{{$val['title']}}" data-id="{{$val['id']}}" 
				data-end_date="{{$val['end_date']}}" data-description="{{$val['description']}}" data-status="{{$val['status']}}" data-start_date="{{$val['start_date']}}"
				 id="list_{{ $val['id'] }}">{{ $val['title'] }}</li>
			@endforeach
		@endif		
		</ul>
	</div>
	<div class="list">
		<h3 class="list-title">DAN </h3>
		<ul class="list-items"  id="DAN">
		@if(isset($user_task['dan']))
			@foreach($user_task['dan'] as $asd => $val)
				<li data-title="{{$val['title']}}" data-id="{{$val['id']}}" 
				data-end_date="{{$val['end_date']}}" data-description="{{$val['description']}}" data-status="{{$val['status']}}" data-start_date="{{$val['start_date']}}"
				 id="list_{{ $val['id'] }}">{{ $val['title'] }}</li>
			@endforeach
		@endif		
		</ul>
	</div>
</section>
<div class="modal" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title" >Title - status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="s_e_date">start_date - end_date</p>
        <div id="description" >description</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary dan" data-id=''>DAN</button>
      </div>
    </div>
  </div>
</div>
<script src="{{asset('/assets/front/assets/js/jquery.min.js')}}"></script>
<script>
    //The homestead or local host server (don't forget the ws prefix)
    var host = 'ws://127.0.0.1:8889';
    var socket = null;
    var input = document.getElementById('input');
    var messages = document.getElementById('messages');
    var print = function (message) {
        var samp = document.createElement('samp');
        samp.innerHTML = '\n' + message + '\n';
        messages.appendChild(samp);
        return;
    };


    try {
        socket = new WebSocket(host);
        
        //Manages the open event within your client code
        socket.onopen = function () {
          	 socket.send('{"onopen":true,"id":<?= Auth::user()->id ?>}');
            
            return;
        };
        //Manages the message event within your client code
        socket.onmessage = function (msg) {

			data = JSON.parse(msg.data)

        	if(data.type == 'new'){
        		addnew(data.task);
        	}
            

            return;
        };


        //Manages the close event within your client code
        socket.onclose = function () {
            return;
        };
    } catch (e) {
        console.log(e);
    }
    $(document).on("click",'.list-items li',function(e) {

  		$('#myModal').show();
  		$("#title").html($(this).data("title")+$(this).data("status"))
  		$("#s_e_date").html($(this).data("start_date")+$(this).data("end_date"))
  		$("#description").html($(this).data("description"))

  		$(".dan").attr("data-id",$(this).attr("data-id"))
  		$(".dan").attr("data-title",$(this).data("title"))
  		$(".dan").attr("data-status",$(this).data("status"))
  		$(".dan").attr("data-start_date",$(this).data("start_date"))
  		$(".dan").attr("data-end_date",$(this).data("end_date"))
  		$(".dan").attr("data-description",$(this).data("description"))

    })    

    $(".close").on("click",function(e) {
  		$('#myModal').hide();
    })    
    $(document).on("click",".dan",function(e) {
		var id_a        = $(".dan").attr("data-id");
		var status      = $(".dan").data("status");
		var title       = $(".dan").data("title");
		var end_date    = $(".dan").data("end_date");
		var description = $(".dan").data("description");
		var status      = $(".dan").data("status");
		var start_date  = $(".dan").data("start_date");
  		socket.send('{"Test":true,"task_id":'+id_a+'}');
		$("#list_"+id_a).remove();
		html = "";
		html += "<li data-id='"+id_a+"' id='list_"+id_a+"' data-title='"+title+"' data-end_date='"+end_date+"' data-description='"+description+"' data-status='"+status+"' data-start_date='"+start_date+"'>"+title+"</li>";
		$("#TEST").append(html);
		$('#myModal').hide();
    })
	function addnew(data) {
		status = data.status
		id = data.id
		title = data.title
		end_date = data.end_date
		description = data.description
		status = data.status
		start_date = data.start_date
		$("#list_"+id).remove();
		html = "";
		html += "<li data-id='"+id+"' id='list_"+id+"' data-title='"+title+"' data-end_date='"+end_date+"' data-description='"+description+"' data-status='"+status+"' data-start_date='"+start_date+"'>"+title+"</li>";
		$("#"+status).append(html);
	}    
</script>

@endsection
