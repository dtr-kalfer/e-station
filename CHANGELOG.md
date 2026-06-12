[unreleased] YYYY-MM-DD
- Added feature: 'Batch Check Active Users'. Displays usage time of all  active user's session. 

[1.6.8] 2026-06-11

- Updated: upgrade_db.php to include more international timezone
- Updated: README.md with additional information.
- Fixed: White fonts on table header color fixed (print_report.php).
- Fixed/Refactor: optimize sql request for print_report.php SQL LEFT JOIN at the top of page. Security fix (SQL injection)
- Fixed/Refactor: Timezone bug, (originally it was specific for Philippines only, so i hardcoded the timezone) updated upgrade_db.php to include timezone record, updated index.php, added config.php, new estation_clean.sql
- Fixed: Variable Overwriting ($row) during click 'check' button where table rendering stops. 

[1.0.0] 2026-06-10

- First relesae