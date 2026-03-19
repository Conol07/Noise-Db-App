<?php
// Generate password hashes for your users
$adminHash = password_hash('admin123', PASSWORD_DEFAULT);
$managerHash = password_hash('manager123', PASSWORD_DEFAULT);
$userHash = password_hash('user123', PASSWORD_DEFAULT);

echo "Admin hash: " . $adminHash . "\n";
echo "Manager hash: " . $managerHash . "\n";
echo "User hash: " . $userHash . "\n";
?>