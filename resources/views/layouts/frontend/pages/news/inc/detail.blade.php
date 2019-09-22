<div class="col-md-8 column">

	<div class="single-page">

		<img src="{{"/images/".$news->file_name?:'/img/gallery/img11.jpg'}}" alt="">

		<h2>{{ucfirst($news->title)}}</h2>

		<div class="meta">

			<ul>

				<li><i class="fa fa-reply"></i> Posted In <a href="#" title="">Story</a></li>

				<li><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::parse($news->created_at)->format('F')}}, {{ \Carbon\Carbon::parse($news->created_at)->format('d')}}, {{ \Carbon\Carbon::parse($news->created_at)->format('Y')}}</li>

				<li><i class="fa fa-user"></i> <a href="#" title="">{{ucwords($news->user()->name)}}</a></li>

			</ul>

			<img src="{{"/images/".$news->file_name?:'/img/gallery/img11.jpg'}}" alt="">

		</div><!-- POST META -->

	</div><!-- SERMON SINGLE -->

	{!! $news->content !!}

	<div class="share-this">

		<h5><i class="fa fa-share"></i> SHARE THIS Cause</h5>

		<ul class="social-media">

			<li><a href="#" title=""><i class="fa fa-linkedin"></i></a></li>

			<li><a href="#" title=""><i class="fa fa-google-plus"></i></a></li>

			<li><a href="#" title=""><i class="fa fa-twitter"></i></a></li>

			<li><a href="#" title=""><i class="fa fa-facebook"></i></a></li>

		</ul>				

	</div><!-- SHARE THIS -->

	@include('layouts.frontend.pages.news.inc.comment')

</div>