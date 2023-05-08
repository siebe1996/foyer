#include <Arduino.h>
#include <FastLED.h>

#define LED_PIN0 7

#define NUM_LEDS 53

CRGB leds0[NUM_LEDS];

void setup() 
{

  FastLED.addLeds<WS2812, LED_PIN0, GRB>(leds0, NUM_LEDS);

}

void loop() {

    for (int i = 0; i <= NUM_LEDS; i++) 
      {
      leds0[i] = CRGB ( 255, 255, 255);
      FastLED.show();
      delay(30);
      }
      for (int i = 0; i <= NUM_LEDS; i++) 
      {
      leds0[i] = CRGB ( 0, 0, 255);
      FastLED.show();
      delay(30);
      }
}
