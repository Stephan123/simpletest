<?php
include_once('../simpletest/autorun.php');
include_once('../classes/guestbook.php');

class TestGuestbook extends UnitTestCase
{
    function testViewGuestbookWithEntries()
    {
        // Vorbereitung
        $guestbook = new Guestbook();

        // neue Datensätze
        $guestbook->add("Kirk", "Kirk");
        $guestbook->add("Ted", "Ted");

        // Ausgabe
        $entries = $guestbook->viewAll();

        // Anzahl der Datensätze
        $count_is_greater_than_zero = (count($entries) > 0);

        $this->assertTrue($count_is_greater_than_zero);
        $this->assertIsA($entries, 'array');

        foreach($entries as $entry) {
            $this->assertIsA($entry, 'array');
            $this->assertTrue(isset($entry['name']));
            $this->assertTrue(isset($entry['message']));
        }
    }

    function testViewGuestbookWithNoEntries()
    {
        $guestbook = new Guestbook();
        $guestbook->deleteAll(); // Delete all the entries first so we know it's an empty table

        $entries = $guestbook->viewAll();

        $this->assertEqual($entries, array());
    }
} 