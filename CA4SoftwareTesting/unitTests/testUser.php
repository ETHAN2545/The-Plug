<?php
require_once '../../ThePlug/classes/User.php';

$user = new User(101, "Usertest@test.com", "Pass215", true);

if ($user->getId() === 101) {
    echo "✅ Test Passed: User ID is correct.<br>";
} else {
    echo "❌ Test Failed: User ID is incorrect.<br>";
}

if ($user->getEmail() === "Usertest@test.com") {
    echo "✅ Test Passed: User Email is correct.<br>";
} else {
    echo "❌ Test Failed: User Email is incorrect.<br>";
}

if ($user->getPassword() === "Pass215") {
    echo "✅ Test Passed: User Password is correct.<br>";
} else {
    echo "❌ Test Failed: User Password is incorrect.<br>";
}

if ($user->isAdmin() === true) {
    echo "✅ Test Passed: User is Admin.<br>";
} else {
    echo "❌ Test Failed: User is not Admin.<br>";
}
?>
