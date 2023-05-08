#include <Arduino.h>
#include <FastLED.h>

#define IR_PIN 4
#define LED_PIN 5
#define NUM_LEDS 60

CRGB leds[NUM_LEDS];
void setup() 
{
  pinMode(IR_PIN, INPUT);//IR sensor
  
  Serial.begin(115200); // Init Serial at 115200 Baud Rate.
  FastLED.addLeds<WS2812, LED_PIN, GRB>(leds, NUM_LEDS);
}

void loop() {
  Serial.println(digitalRead(IR_PIN));
   if(digitalRead(IR_PIN)==0)
   {
      for (int i = 0; i <= 59; i++) 
      {
      leds[i] = CRGB ( 0, 0, 255);
      FastLED.show();
      delay(10);
      }
   }
   else
   {
      for (int i = 0; i <= 59; i++) 
      {
      leds[i] = CRGB ( 0, 255, 0);
      FastLED.show();
      delay(10);
      }
   }
}
