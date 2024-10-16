<script>
    const base_url = "<?= base_url() ?>";
    const arrInfoUserActive = <?= isset($_SESSION["chat"]["infoUSer"]) ? json_encode($_SESSION["chat"]["infoUSer"]) : null; ?>;
</script>
<script src="<?= media() ?>/js/libraries/main.js"></script>
<script src="<?= media() ?>/js/<?= $data["page_filejs"]["file1"] ?>"></script>
<script src="<?= media() ?>/js/<?= $data["page_filejs"]["file2"] ?>"></script>
</body>

</html>