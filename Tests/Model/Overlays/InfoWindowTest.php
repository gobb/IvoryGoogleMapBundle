<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Overlays;

use Ivory\GoogleMapBundle\Tests\Model\Assets\AbstractOptionsAssetTest;

use Ivory\GoogleMapBundle\Model\Overlays\InfoWindow;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;
use Ivory\GoogleMapBundle\Model\Base\Size;

/**
 * Info window test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowTest extends AbstractOptionsAssetTest
{   
    /**
     * @override
     */
    protected function setUp()
    {
        self::$object = new InfoWindow();
    }
    
    /**
     * @override
     */
    public function testJavascriptVariable() 
    {
        $this->assertEquals(substr(self::$object->getJavascriptVariable(), 0, 12), 'info_window_');
    }
    
    /**
     * @override
     */
    public function testDefaultValues()
    {
        parent::testDefaultValues();
        
        $this->assertNull(self::$object->getPosition());
        $this->assertNull(self::$object->getPixelOffset());
        $this->assertEquals(self::$object->getContent(), '<p>Default content</p>');
        $this->assertTrue(self::$object->isOpen());
    }
    
    /**
     * Checks the position getter & setter
     */
    public function testPosition()
    {
        $coordinateTest = new Coordinate(1.1, 1.1, true);
        self::$object->setPosition($coordinateTest);
        $this->assertEquals(self::$object->getPosition()->getLatitude(), 1.1);
        $this->assertEquals(self::$object->getPosition()->getLongitude(), 1.1);
        $this->assertTrue(self::$object->getPosition()->isNoWrap());
        
        self::$object->setPosition(2.1, 2.1, false);
        $this->assertEquals(self::$object->getPosition()->getLatitude(), 2.1);
        $this->assertEquals(self::$object->getPosition()->getLongitude(), 2.1);
        $this->assertFalse(self::$object->getPosition()->isNoWrap());
        
        self::$object->setPosition(null);
        $this->assertNull(self::$object->getPosition());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$object->setPosition('foo');
    }
    
    /**
     * Checks the pixel offset getter & setter
     */
    public function testPixelOffset()
    {
        $pixelOffsetTest = new Size(1, 2, 'px', 'px');
        self::$object->setPixelOffset($pixelOffsetTest);
        $this->assertEquals(self::$object->getPixelOffset()->getWidth(), 1);
        $this->assertEquals(self::$object->getPixelOffset()->getHeight(), 2);
        $this->assertEquals(self::$object->getPixelOffset()->getWidthUnit(), 'px');
        $this->assertEquals(self::$object->getPixelOffset()->getHeightUnit(), 'px');
        
        self::$object->setPixelOffset(3, 4, 'px', 'px');
        $this->assertEquals(self::$object->getPixelOffset()->getWidth(), 3);
        $this->assertEquals(self::$object->getPixelOffset()->getHeight(), 4);
        $this->assertEquals(self::$object->getPixelOffset()->getWidthUnit(), 'px');
        $this->assertEquals(self::$object->getPixelOffset()->getHeightUnit(), 'px');
        
        self::$object->setPixelOffset(null);
        $this->assertNull(self::$object->getPixelOffset());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$object->setPixelOffset('foo');
    }
    
    /**
     * Checks the content getter & setter
     */
    public function testContent()
    {
        self::$object->setContent('content');
        $this->assertEquals(self::$object->getContent(), 'content');
        
        $this->setExpectedException('InvalidArgumentException');
        self::$object->setContent(0);
    }
    
    /**
     * Checks the open getter & setter
     */
    public function testOpen()
    {
        self::$object->setOpen(false);
        $this->assertFalse(self::$object->isOpen());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$object->setOpen('foo');
    }
}
