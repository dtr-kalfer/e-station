[unreleased] yyyy-mm-dd

- Fixed: White fonts on table header color fixed (print_report).
- Fixed/Refactor: optimize sql request for print_report.php SQL LEFT JOIN at the top of page. Security fix (SQL injection)
- Fixed: Timezone bug, updated upgrade_db.php to include timezone record, updated index.php, added config.php, new estation_clean.sql
- Fixed: Variable Overwriting ($row) during click 'check' button where table rendering stops. 

[1.0.0] yyyy-mm-dd

- First relesae