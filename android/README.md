# Code Panda Android App

## Prerequisites

- Android Studio Hedgehog (2023.1.1) or newer
- JDK 17
- A Firebase project (free tier)

## Setup Instructions

### 1. Firebase Setup (Required for Push Notifications)

1. Go to https://console.firebase.google.com
2. Create a new project (or use existing)
3. Add an Android app with package name `com.codepanda.app`
4. Download the `google-services.json` file
5. Replace `android/app/google-services.json` with the downloaded file
6. Copy the **Server Key** from Firebase Console → Project Settings → Cloud Messaging
7. Set it as an environment variable on your VPS:
   ```
   export FCM_SERVER_KEY="your_server_key_here"
   ```
   Or edit `fcm/config.php` directly.

### 2. Open in Android Studio

1. Open Android Studio
2. Click "Open an Existing Project"
3. Select the `android` folder
4. Let Gradle sync complete

### 3. Build & Run

- **Debug:** Click Run (green triangle) or use `./gradlew assembleDebug`
- **Release:** `./gradlew assembleRelease` (generates APK in `app/build/outputs/apk/release/`)
- **App Bundle:** `./gradlew bundleRelease` (for Play Store upload)

### 4. Generate Signed App Bundle (Play Store)

```bash
./gradlew bundleRelease
# The AAB will be at: app/build/outputs/bundle/release/app-release.aab
```

You'll need a keystore. Create one via Android Studio:
- Build → Generate Signed App Bundle / APK
- Follow the wizard to create a new keystore

## Project Structure

```
android/
├── app/
│   ├── src/main/
│   │   ├── java/com/codepanda/app/
│   │   │   ├── MainActivity.kt          # Main activity with bottom nav
│   │   │   ├── SplashActivity.kt        # Splash screen
│   │   │   ├── CodePandaApp.kt          # Application class
│   │   │   ├── ui/webview/              # WebView fragments
│   │   │   ├── ui/domain/               # Domain checker fragment
│   │   │   ├── ui/whatsapp/             # WhatsApp fragment
│   │   │   ├── ui/account/              # Account fragment
│   │   │   ├── service/                 # FCM service
│   │   │   ├── network/                 # Retrofit API client
│   │   │   └── util/                    # Helpers
│   │   ├── res/                         # Resources
│   │   └── AndroidManifest.xml
│   └── build.gradle.kts
├── build.gradle.kts
└── settings.gradle.kts
```

## Features

- WebView wrapper for code-panda.online
- Native domain availability checker
- Native WHOIS lookup
- WhatsApp order integration
- FCM push notifications
- Pull-to-refresh, share, cache clearing
- Offline detection & retry
