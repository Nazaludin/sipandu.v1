<div id="back-top">
    <a class="btn btn-primary btn-icon rounded-circle" title="Menuju Atas" data-scroll="up">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M6 15l6 -6l6 6"></path>
        </svg>
    </a>
</div>
<style>
    #back-top {
        position: fixed;
        right: 30px;
        bottom: 30px;
        cursor: pointer;
        z-index: 9999999;
        display: none;
    }
</style>


<script>
    const btnScrollToTop = document.querySelector("#back-top");

    // scroll to top of page when button clicked
    btnScrollToTop.addEventListener("click", e => {
        window.scrollTo({
            top: 0,
            left: 0,
            behavior: "smooth"
        });
    });

    // toggle 'scroll to top' based on scroll position
    window.addEventListener('scroll', e => {
        btnScrollToTop.style.display = window.scrollY > 40 ? 'block' : 'none';
    });
</script>
</div>
<!-- Libs JS -->
<script src="<?= base_url('dist/libs/apexcharts/dist/apexcharts.min.js?1685973381'); ?>" defer></script>
<script src="<?= base_url('dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1685973381'); ?>" defer></script>
<script src="<?= base_url('dist/libs/jsvectormap/dist/maps/world.js?1685973381'); ?>" defer></script>
<script src="<?= base_url('dist/libs/jsvectormap/dist/maps/world-merc.js?1685973381'); ?>" defer></script>
<!-- Tabler Core -->
<script src="<?= base_url('dist/js/tabler.min.js?1685973381'); ?>" defer></script>
<script src="<?= base_url('dist/js/demo.min.js?1685973381'); ?>" defer></script>

</body>

</html>