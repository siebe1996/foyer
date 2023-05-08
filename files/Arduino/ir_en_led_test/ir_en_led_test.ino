#include <Arduino.h>
#include <FastLED.h>

#define IR_PIN 4
#define IR_PIN2 5
#define LED_PIN 7
#define NUM_LEDS 53

CRGB leds[NUM_LEDS];
void setup() 
{
  pinMode(IR_PIN, INPUT);//IR sensor
  pinMode(IR_PIN2, INPUT);//IR sensor
  Serial.begin(9600); // Init Serial at 115200 Baud Rate.
  FastLED.addLeds<WS2812, LED_PIN, GRB>(leds, NUM_LEDS);
}

void loop() {
   if(digitalRead(IR_PIN)==0 || digitalRead(IR_PIN2)==0)
   {
      for (int i = 0; i < NUM_LEDS; i++) 
      {
      leds[i] = CRGB ( 0, 0, 255);
      FastLED.show();
      delay(10);
      }
   }
   else
   {
      for (int i = 0; i < NUM_LEDS; i++) 
      {
      leds[i] = CRGB ( 0, 255, 0);
      FastLED.show();
      }
   }
}
