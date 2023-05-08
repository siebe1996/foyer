#include <SPI.h>
#include <Adafruit_GFX.h>    // Core graphics library
#include <Adafruit_ST7735.h> // Hardware-specific library

#define TFT_CS 10
#define TFT_RST 8 // Or set to -1 and connect to Arduino RESET pin
#define TFT_DC 9

Adafruit_ST7735 tft = Adafruit_ST7735(TFT_CS, TFT_DC, TFT_RST);

void setup(void) {
  tft.initR(INITR_BLACKTAB);  // Init ST7735R chip, green tab
  tft.fillScreen(ST77XX_WHITE);
  tft.setRotation(1); // set display orientation 
  tft.setTextSize(15);
}

void loop() {
  int number = 3;
   testdrawtext(String(number), ST77XX_BLACK);
  delay(2000);

}

void testdrawtext(String text, uint16_t color) {
  tft.setCursor(50, 10);
  tft.setTextColor(color);
  tft.setTextWrap(true);

  tft.print(text);
}
/*
1: GND - aarde 
2: VCC - 3,3 V (niet aangesloten) 
3: SCK (SPI-klok) - D12 
4: SDA (SPI-gegevens) - D13 
5: RST RESET-controller - D14 
6: RS (RS/DC SPI-signaal) - D26 
7: CS - D27 
8: LEDA (Turn on/off background LED)*/
