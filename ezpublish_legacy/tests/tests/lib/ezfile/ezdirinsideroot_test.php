<?php
/**
 * File containing the eZDirTestInsideRoot class
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @version 2014.07.0
 * @package tests
 */

class eZDirTestInsideRoot extends ezpTestCase
{
    private $rootDir = 'var/tests/eZDirTestInsideRoot/';

    public function __construct()
    {
        parent::__construct();
        $this->setName( "eZDirTestInsideRoot" );
    }

    public function setUp()
    {
        parent::setUp();
        file_exists( $this->rootDir ) or @mkdir( $this->rootDir, 0777, true );
        file_exists( $this->rootDir . 'a/b/c/' ) or @mkdir( $this->rootDir . 'a/b/c/', 0777, true );
        touch( $this->rootDir . 'a/fileA' );
        touch( $this->rootDir . 'a/b/fileB' );
    }

    public function tearDown()
    {
        foreach ( array( $this->rootDir . 'a/fileA',
                         $this->rootDir . 'a/b/fileB' ) as $file )
            file_exists( $file ) && unlink( $file );

        foreach ( array( $this->rootDir . 'a/b/c/',
                         $this->rootDir . 'a/b/',
                         $this->rootDir . 'a/',
                         $this->rootDir) as $dir )
            file_exists( $dir ) && rmdir( $dir );

        parent::tearDown();
    }

    public function testRemoveWithoutCheck()
    {
        $this->assertTrue( eZDir::recursiveDelete( $this->rootDir . 'a/b/c/', false ) );
        $this->assertFalse( file_exists( $this->rootDir . 'a/b/c' ) );
    }

    public function testRemoveWithoutCheckNoTrailingSlash()
    {
        $this->assertTrue( eZDir::recursiveDelete( $this->rootDir . 'a/b/c', false ) );
        $this->assertFalse( file_exists( $this->rootDir . 'a/b/c' ) );
    }

    public function testRemoveWithCheck()
    {
        $this->assertTrue( eZDir::recursiveDelete( $this->rootDir . 'a/b/c/', true ) );
        $this->assertFalse( file_exists( $this->rootDir . 'a/b/c' ) );
    }

    public function testRemoveRecursivelyWithoutCheck()
    {
        $this->assertTrue( eZDir::recursiveDelete( $this->rootDir . 'a/', false ) );
        $this->assertFalse( file_exists( $this->rootDir . 'a' ) );
    }

    public function testRemoveRecursivelyWithoutCheckNoTrailingSlash()
    {
        $this->assertTrue( eZDir::recursiveDelete( $this->rootDir . 'a', false ) );
        $this->assertFalse( file_exists( $this->rootDir . 'a' ) );
    }

    public function testRemoveRecursivelyWithCheck()
    {
        $this->assertTrue( eZDir::recursiveDelete( $this->rootDir . 'a/', true ) );
        $this->assertFalse( file_exists( $this->rootDir . 'a' ) );
    }

    public function testRemoveRecursivelyWithCheckNoTrailingSlash()
    {
        $this->assertTrue( eZDir::recursiveDelete( $this->rootDir . 'a', true ) );
        $this->assertFalse( file_exists( $this->rootDir . 'a' ) );
    }

    public function testRemoveWithoutCheckNotExisting()
    {
        $this->assertFalse( eZDir::recursiveDelete( $this->rootDir . 'doesNotExist', false ) );
    }

    public function testRemoveWithCheckNotExisting()
    {
        $this->assertFalse( eZDir::recursiveDelete( $this->rootDir . 'doesNotExist', true ) );
    }
}

?>
