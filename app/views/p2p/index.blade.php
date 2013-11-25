@extends('layout')

@section('content')
    <h1>p2p social network</h1>

    <section>
        <p>Your Peer ID: <span id="peerID"></span></p>
    </section>

    <section>
        <label>Connect To: <input id="connectID" type="text"></label>
        <button id="connect">Connect</button>
    </section>

    <video id="localVideo" autoplay style="float: left; width: 200px; height: 200px; background: #000;"></video>
    <video id="remoteVideo" autoplay style="float: right; width: 600px; height: 600px; background: #000;"></video>

    <!--<script src="/vendor/adapter.js"></script>
    <script src="/javascripts/Logger.js"></script>
    <script src="/javascripts/RTC/MediaStream.js"></script>
    <script src="/javascripts/RTC/PeerConnection.js"></script>
    <script src="/javascripts/App.js"></script>-->

    <script src="/vendor/peer.js"></script>
    <script src="/javascripts/p2p/Logger.js"></script>
    <script src="/javascripts/p2p/MediaStream.js"></script>
    <script src="/javascripts/p2p/App.js"></script>
@stop