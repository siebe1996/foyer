#include <Arduino.h>
#include <ESP8266WiFi.h>        // Include the Wi-Fi library
#include <WiFiClientSecure.h>
#include <ArduinoJson.h>
const char* ssid = "wifiVanPoucke"; // The name of the Wi-Fi network that will be created
const char* password = "wifiVanPoucke";   // The password required to connect to it, leave blank for an open network
String server = "fooseball-api-test.siebevandevoorde.ikdoeict.be";

const char* fingerprint = "3A:C1:69:8D:B8:79:54:38:21:4D:2E:D6:C1:6D:D6:0F:9A:B9:08:CF";

WiFiClientSecure client;
void setup()
{
  // Start serial
  Serial.begin(9600);

  connectToWifi();
}
void loop() {
  //startGame();
  //delay(10000);
  //stopGame();
  updateScore(12, 1);
  delay(10000);
}
void updateScore(int team, int score) {

  if (WiFi.status() == WL_CONNECTED) {
    if (!client.connect(server, 443))
      Serial.println("Connection failed!");
    else {
      String endpoint = "/api/table/1/team/12";
      const char* contentType = "application/json";

      // Create a JSON object
      StaticJsonDocument<64> doc;
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
      // Wait for server response
      while (!client.available()) {
        delay(10);
      }

      // Read server response
      while (client.available()) {
        Serial.write(client.read());
      }
      client.stop();
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
      String endpoint = "/api/table/1/start";
      const char* contentType = "application/x-www-form-urlencoded";

      String request = "GET " + endpoint + " HTTP/1.1\r\n" + "Host: " + server + "\r\n" + "Content-Type: " + contentType + "\r\n" + "Connection: close\r\n\r\n";

      client.print(request);
      client.stop();
    }
  }
}
void stopGame()
{
  Serial.println("stop...");
  if (WiFi.status() == WL_CONNECTED)
  {
    if (!client.connect(server, 443))
      Serial.println("Connection failed!");
    else {
      String endpoint = "/api/table/1/end";
      const char* contentType = "application/x-www-form-urlencoded";

      String request = "GET " + endpoint + " HTTP/1.1\r\n" + "Host: " + server + "\r\n" + "Content-Type: " + contentType + "\r\n" + "Connection: close\r\n\r\n";

      client.print(request);
      client.stop();
    }
  }
}
void connectToWifi()
{
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");
  client.setFingerprint(fingerprint);


}
