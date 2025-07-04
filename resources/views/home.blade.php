@extends('layouts.app')

@section('content')
<style>
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
    }

    .video-container {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }

    video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<div class="video-container">
    <video id="fullscreen-video" autoplay muted loop>
        <source src="{{ asset('videos/i.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<script>
    document.getElementById('fullscreen-video').addEventListener('click', function() {
        var elem = document.getElementById('fullscreen-video');
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        }
    });
</script>
@endsection
