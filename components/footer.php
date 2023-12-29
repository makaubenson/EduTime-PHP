<!-- Footer -->
<footer class="page-footer font-small ">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3 fixed-bottom bg-info text-light">© <span id="year"></span> Copyright:
        <a href="https://maseno.ac.ke" class="text-light"> Maseno University</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->

<!--get current year script-->
<script>
    //Update Year on the copyright section
const year = new Date().getFullYear();
document.getElementById("year").textContent = year;
</script>