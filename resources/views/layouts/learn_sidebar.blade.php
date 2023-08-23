<div class="sidebar sidebar-dark-theme" id="sidebar">
    <div class="help-section">
        <div class="description">
            <h1 class="title row">
            @if($learn)
                {{ $learn->title }}
            @endif
            </h1>
            @if($learn)
                {!! $learn->content !!}
            @endif
        </div>
        <div class="video-section">
            <div class="chart">
                <span>IMAGE OR EMBEDDED VIDEO</span>
                <div class="title">
                    <span>as of 25 May 2019.09:41 PM</span>
                    <span>
                        Today
                    </span>
                    <span>
                        Yesterday
                    </span>
                </div>
                <div id="chartContainer" style="height: 200px; width: 100%;"></div>

            </div>
            <div class="calc-section">
                <div class="item">
                    <span>Resolved</span>
                    <h2>
                    @if($learn)
                        {{ $learn->resolved_num }}
                    @endif
                    </h2>
                </div>
                <hr>
                <div class="item">
                    <span>Received</span>
                    <h2>
                    @if($learn)
                        {{ $learn->received_num }}
                    @endif
                    </h2>
                </div>
                <hr>
                <div class="item">
                    <span>Average first reponse time</span>
                    <h2>
                    @if($learn)
                        {{ $learn->response_time }}mm
                    @endif
                    </h2>
                </div>
            </div>
        </div>
    </div>
	<div class="download-section flex">
    @if($attachments)
        @foreach ($attachments as $row)
            <div class="item flex-1">
                <img src="{{ asset('pdf.svg') }}" class="w-50" alt="">
                <span><a href="{{ Storage::url($row->file_url) }}" download>{{ $row->filename }}</a></span>
            </div>
        @endforeach
    @endif
	</div>
    <div class="sticky-button" id="sticky-button">
        Learn
    </div>
</div>

@push('scripts')
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        data: [{
            type: "line",
            indexLabelFontSize: 16,
            dataPoints: [
                { y: 450 },
                { y: 414},
                { y: 520, indexLabel: "\u2191 highest",markerColor: "red", markerType: "triangle" },
                { y: 460 },
                { y: 450 },
                { y: 500 },
                { y: 480 },
                { y: 480 },
                { y: 410 , indexLabel: "\u2193 lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
                { y: 500 },
                { y: 480 },
                { y: 510 }
            ]
        }]
        });
        chart.render();
    }

    $.fn.clickToggle = function(a, b) {
        return this.on("click", function(ev) { [b, a][this.$_io ^= 1].call(this, ev) })
    };

    $("#sticky-button").clickToggle(
        function() {
            $("#sidebar").animate({right: "-2%",}, 1000);
            $(".featured-container").addClass("vertical-lay")

        }, function() {
            $("#sidebar").animate({right: "-48%",}, 1000);
            $(".featured-container").removeClass("vertical-lay")
    });

</script>

@endpush


