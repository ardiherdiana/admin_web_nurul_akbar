</div> <!-- End of flex container -->

    <script>
        // Format numbers for currency display
        document.querySelectorAll('.format-rupiah').forEach(function(element) {
            if (element.textContent && !element.textContent.includes('Rp')) {
                const value = parseInt(element.textContent);
                if (!isNaN(value)) {
                    element.textContent = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(value);
                }
            }
        });
    </script>
</body>
</html>