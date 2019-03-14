#include <SPI.h>
#include <MFRC522.h>

#define SS_PIN 10
#define RST_PIN 9

MFRC522 rfid(SS_PIN, RST_PIN); // Instance of the class

MFRC522::MIFARE_Key key;

// Init array that will store UID
byte uid[4];

void setup() {
  Serial.begin(9600);
  SPI.begin(); // Init SPI bus
  rfid.PCD_Init(); // Init MFRC522
  for (byte i = 0; i < 6; i++) {
    key.keyByte[i] = 0xFF;
  }
}
void printHex(byte *buffer, byte bufferSize) {
  for (byte i = 0; i < bufferSize; i++) {
    Serial.print(buffer[i] < 0x10 ? "0" : "");
    Serial.print(buffer[i], HEX);
  }
}
void loop() {
if (rfid.PICC_IsNewCardPresent() && rfid.PICC_ReadCardSerial()){
 for (byte i = 0; i < 4; i++) {
      uid[i] = rfid.uid.uidByte[i];
 }
 printHex(rfid.uid.uidByte, rfid.uid.size);
 Serial.println();
 rfid.PICC_HaltA();
 rfid.PCD_StopCrypto1();
}
}
