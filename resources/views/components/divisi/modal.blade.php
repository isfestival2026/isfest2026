<div class="modal-overlay" id="modal-overlay">
    <div class="modal-box" onclick="event.stopPropagation()">
        <button class="modal-close" id="modal-close">✕</button>

        <div class="slider-wrap">
            <div class="slider-track" id="slider-track"></div>
            <button class="slider-btn prev" onclick="slide(-1)">‹</button>
            <button class="slider-btn next" onclick="slide(1)">›</button>
            <div class="slider-dots" id="slider-dots"></div>
        </div>

        <div class="modal-body">
            <div class="modal-head">
                <img id="m-logo" src="" alt="Divisi Logo">
                <div>
                    <h2 id="m-name"></h2>
                    <p id="m-label"></p>
                </div>
            </div>
            <div id="m-members"></div>
        </div>
    </div>
</div>