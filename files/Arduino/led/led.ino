#include <Arduino.h>
#include <FastLED.h>

#define LED_PIN0 7
#define LED_PIN1 6
#define LED_PIN2 5
#define LED_PIN3 4
#define LED_PIN4 3

#define IR_PIN 8
#define IR_PIN2 9

#define NUM_LEDS 37
#define NUM_LEDS2 53

CRGB leds0[NUM_LEDS];
CRGB leds1[NUM_LEDS];
CRGB leds2[NUM_LEDS];
CRGB leds3[NUM_LEDS];
CRGB leds4[NUM_LEDS2];

void setup()
{
  pinMode(IR_PIN, INPUT);//IR sensor
  pinMode(IR_PIN2, INPUT);//IR sensor

  FastLED.addLeds<WS2812, LED_PIN0, GRB>(leds0, NUM_LEDS);
  FastLED.addLeds<WS2812, LED_PIN1, GRB>(leds1, NUM_LEDS);
  FastLED.addLeds<WS2812, LED_PIN2, GRB>(leds2, NUM_LEDS);
  FastLED.addLeds<WS2812, LED_PIN3, GRB>(leds3, NUM_LEDS);
  FastLED.addLeds<WS2812, LED_PIN4, GRB>(leds4, NUM_LEDS2);
  for (int i = 0; i <= NUM_LEDS; i++)
  {
    leds0[i] = CRGB ( 0, 0, 255);
    leds1[i] = CRGB ( 0, 0, 255);
    leds2[i] = CRGB ( 255, 0, 0);
    leds3[i] = CRGB ( 255, 0, 0);
    FastLED.show();
  }
  for (int i = 0; i <= NUM_LEDS2; i++)
  {
    leds4[i] = CRGB ( 255, 255, 255);
    FastLED.show();
  }
}

void loop() {


  if (digitalRead(IR_PIN) == 0 )
  {
    for (int i = 0; i <= NUM_LEDS; i++)
    {
      leds2[i] = CRGB ( 0, 255, 255);
      leds3[i] = CRGB ( 0, 255, 255);
      delay(40);
      FastLED.show();
    }
    delay(1000);
    for (int i = 0; i <= NUM_LEDS; i++)
    {
      leds2[i] = CRGB ( 255, 0, 0);
      leds3[i] = CRGB ( 255, 0, 0);
      FastLED.show();
    }
  }
  else if (digitalRead(IR_PIN2) == 0 )
  {
    for (int i = 0; i <= NUM_LEDS; i++)
    {
      leds0[i] = CRGB ( 0, 255, 255);
      leds1[i] = CRGB ( 0, 255, 255);
      delay(40);
      FastLED.show();
    }
    delay(1000);
    for (int i = 0; i <= NUM_LEDS; i++)
    {
      leds0[i] = CRGB ( 0, 0, 255);
      leds1[i] = CRGB ( 0, 0, 255);
      FastLED.show();
    }
  }




}
