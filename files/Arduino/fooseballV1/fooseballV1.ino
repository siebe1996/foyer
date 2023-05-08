#include <Arduino.h>
#include <FastLED.h>
#include <ESP8266WiFi.h>        // Include the Wi-Fi library
#include <WiFiClientSecure.h>
#include <ArduinoJson.h>
const char* ssid = "wifiVanPoucke"; // The name of the Wi-Fi network that will be created
const char* password = "wifiVanPoucke";   // The password required to connect to it, leave blank for an open network
String server = "fooseball-api-test.siebevandevoorde.ikdoeict.be";

const char* fingerprint = "3A:C1:69:8D:B8:79:54:38:21:4D:2E:D6:C1:6D:D6:0F:9A:B9:08:CF";

WiFiClientSecure client;


#define LEDSLIGHT_PIN 16
#define LED_PIN0 5
#define LED_PIN1 4
#define LED_PIN2 0
#define LED_PIN3 2


#define IR_PIN 9 //team1
#define IR_PIN2 10 //team2

#define buttonLeft 14 //start
#define buttonMiddle 12 //middenveld
#define buttonRight 13 //stop/reset


#define NUM_LEDS 37
#define NUM_LEDSLIGHT 53
#define NUM_STRIPS 4

CRGB leds[NUM_STRIPS][NUM_LEDS];
CRGB ledlight[NUM_LEDSLIGHT];

String tableId = "1";
int scoreTeam1 = 0;
int scoreTeam2 = 0;
boolean inGame = false;
int lastGoal = 0;

void connectToWifi();
void goalTeam1();
void goalTeam2();
void setLedstrip(CRGB led[], int numleds, int red, int green, int blue);
void setLedstripsTeam(CRGB led1[], CRGB led2[], int numleds, int red, int green, int blue);

void setup()
{
  // Start serial
  Serial.begin(9600);

  connectToWifi();
  pinMode(IR_PIN, INPUT);//IR sensor
  pinMode(IR_PIN2, INPUT);//IR sensor

  pinMode(buttonLeft, INPUT);
  pinMode(buttonMiddle, INPUT);
  pinMode(buttonRight, INPUT);
  FastLED.addLeds<WS2812, LED_PIN0, GRB>(leds[0], NUM_LEDS);//ledstrip team1
  FastLED.addLeds<WS2812, LED_PIN1, GRB>(leds[1], NUM_LEDS);//ledstrip team1

  FastLED.addLeds<WS2812, LED_PIN2, GRB>(leds[2], NUM_LEDS);//ledstrip team2
  FastLED.addLeds<WS2812, LED_PIN3, GRB>(leds[3], NUM_LEDS);//ledstrip team2

  FastLED.addLeds<WS2812, LEDSLIGHT_PIN, GRB>(ledlight, NUM_LEDSLIGHT);//ledstrip top

  setLedstrip(ledlight, NUM_LEDSLIGHT, 255, 255, 255); //white
  setLedstripsTeam(leds[0], leds[1], NUM_LEDS, 0, 0, 255); //blue
  setLedstripsTeam(leds[2], leds[3], NUM_LEDS, 255, 0, 0); //red
}

void loop() {

  if (digitalRead(IR_PIN) == 0 )
  {
    goalTeam1();
  }
  else if (digitalRead(IR_PIN2) == 0 )
  {
    goalTeam2();
  }
  else if (digitalRead(buttonLeft) == 0 && inGame == false)//start
  {
    Serial.println("start failed!");
    inGame = true;
    scoreTeam1 = 0;
    scoreTeam2 = 0;
    startGame();
  }
  else if (digitalRead(buttonRight) == 0 && inGame == true)//stop
  {
    inGame = false;
    scoreTeam1 = 0;
    scoreTeam2 = 0;
    stopGame();
  }
  else if (digitalRead(buttonMiddle) == 0 && inGame == true)
  {
    if (lastGoal == 1) {
      scoreTeam1--;
      //update score team1 api
      updateScore(1, -1);
    }
    if (lastGoal == 2) {
      scoreTeam2--;
      //update score team2 api
      updateScore(2, -1);
    }
  }
}
void startGame()
{
  if (WiFi.status() == WL_CONNECTED)
  {
    if (!client.connect(server, 443))
      Serial.println("Connection failed!");
    else {
       Serial.println("start!");
      String endpoint = "/api/table/1/start";
      const char* contentType = "application/x-www-form-urlencoded";

      String request = "GET " + endpoint + " HTTP/1.1\r\n" + "Host: " + server + "\r\n" + "Content-Type: " + contentType + "\r\n" + "Connection: close\r\n\r\n";

      client.print(request);
      client.stop();
    }
  }
}
void stopGame() {
  if (WiFi.status() == WL_CONNECTED)
  {
    if (!client.connect(server, 443))
      Serial.println("Connection failed!");
    else {
       Serial.println("stop!");
      String endpoint = "/api/table/1/end";
      const char* contentType = "application/x-www-form-urlencoded";

      String request = "GET " + endpoint + " HTTP/1.1\r\n" + "Host: " + server + "\r\n" + "Content-Type: " + contentType + "\r\n" + "Connection: close\r\n\r\n";

      client.print(request);
      client.stop();
    }
  }

}
void updateScore(int team, int score) {
  if (WiFi.status() == WL_CONNECTED) {
    if (!client.connect(server, 443)) {
      Serial.println("Connection failed!");
    } else {
      setLedstrip(ledlight, NUM_LEDSLIGHT, 0, 255, 0); //white
      String endpoint = "/api/table/1/team/12";
      const char* contentType = "application/json";

      // Create a JSON object
      DynamicJsonDocument doc(16);
      doc["score_change"] = score;

      // Serialize the JSON object
      String payload;
      serializeJson(doc, payload);

      // Create the HTTP request
      String request = "PATCH " + endpoint + " HTTP/1.1\r\n" +
                       "Host: " + server + "\r\n" +
                       "Content-Type: " + contentType + "\r\n" +
                       "Content-Length: " + String(payload.length()) + "\r\n" +
                       "Connection: close\r\n\r\n" +
                       payload;

      // Send the request
      client.print(request);

      setLedstrip(ledlight, NUM_LEDSLIGHT, 255, 255, 255); //white
      client.stop();
    }
  }
}



void connectToWifi()
{
  WiFi.begin(ssid, password);
  client.setFingerprint(fingerprint);
}
void goalTeam1() {
  scoreTeam1++;
  lastGoal = 1;

  for (int i = 0; i <= 6; i++)
  {
    setLedstripsTeam(leds[0], leds[1], NUM_LEDS, 0, 0, 0); //off
    delay(300);
    setLedstripsTeam(leds[0], leds[1], NUM_LEDS, 0, 0, 255); //blue
  }
    updateScore(1, 1);
}
void goalTeam2() {
  scoreTeam2++;
  lastGoal = 2;
  
  for (int i = 0; i <= 6; i++)
  {
    setLedstripsTeam(leds[2], leds[3], NUM_LEDS, 0, 0, 0); //off
    delay(300);
    setLedstripsTeam(leds[2], leds[3], NUM_LEDS, 255, 0, 0); //red
  }
  updateScore(2, 1);
}
void setLedstrip(CRGB led[], int numleds, int red, int green, int blue)
{
  for (int i = 0; i <= numleds; i++)
  {
    led[i] = CRGB ( red, green, blue);
    FastLED.show();
  }
}
void setLedstripsTeam(CRGB led1[], CRGB led2[], int numleds, int red, int green, int blue)
{
  for (int i = 0; i <= numleds; i++)
  {
    led1[i] = CRGB ( red, green, blue);
    led2[i] = CRGB ( red, green, blue);
    FastLED.show();
  }
}
