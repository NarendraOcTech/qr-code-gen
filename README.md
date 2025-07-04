---

## 📄 README.md

````markdown
# QR Code Generator API

This project provides a simple PHP API built with [Slim Framework](https://www.slimframework.com/) to generate QR codes with a label (caption) below the QR image. The API takes a list of IDs and creates a separate QR code for each, returning their URLs in a JSON response.

---

## 🚀 Features

✅ Accepts JSON payloads with an array of IDs  
✅ Generates a unique QR code for each ID  
✅ Adds a label (caption) with the ID text **below** the QR image  
✅ Saves generated images to a `qrcodes/` directory  
✅ Returns direct URLs to the generated QR images  
✅ Uses high-performance [endroid/qr-code](https://github.com/endroid/qr-code) library

---

## 📦 Requirements

- PHP 7.4 or newer
- Composer
- Web server (Apache, Nginx, or built-in PHP server)

---

## 📥 Installation

1. Clone this repository or download the files.

2. Install dependencies with Composer:

   ```bash
   composer install
````

3. Start the PHP built-in server (for local testing):

   ```bash
   php -S localhost:8080
   ```

4. Ensure the `qrcodes/` directory exists and is writable. The app will create it automatically if missing.

---

## 📡 Usage

Send a POST request to `/generate-qr` with a JSON body containing an array of IDs. Each ID will generate a separate QR code.

### Example request

```bash
curl -X POST http://localhost:8080/generate-qr \
  -H "Content-Type: application/json" \
  -d '{"ids": ["123", "456", "789"]}'
```

### Example response

```json
{
  "status": "success",
  "qrcodes": [
    {
      "id": "123",
      "qr_url": "http://your-domain.com/qrcodes/qr_123.png"
    },
    {
      "id": "456",
      "qr_url": "http://your-domain.com/qrcodes/qr_456.png"
    },
    {
      "id": "789",
      "qr_url": "http://your-domain.com/qrcodes/qr_789.png"
    }
  ]
}
```

**Note:** Replace `http://your-domain.com` in the PHP code with your actual server/domain.

---

## 🛠 How it works

* The endpoint `/generate-qr` parses your JSON payload.
* For each ID:

  * Generates a QR code encoding the ID itself.
  * Adds the ID as a label (caption) below the QR using `Endroid\QrCode\Label`.
  * Saves the image to the `qrcodes/` folder.
* Returns a JSON object with the URLs to each generated QR code.

---

## 📝 Customization

You can easily customize the generated QR codes by editing `index.php`:

* Change QR size (`setSize()`)
* Adjust margin (`setMargin()`)
* Customize the label text, font, or color (see endroid/qr-code docs)
* Modify the output image path or filename

---

## 🔒 Security notes

This API currently accepts any JSON payload. Consider adding authentication, rate limiting, or input validation if deploying to a public server.

---

## 📄 License

MIT License.

---

## 🙏 Credits

* [Slim Framework](https://www.slimframework.com/)
* [Endroid QR Code](https://github.com/endroid/qr-code)

```

---

Would you like me to create this file directly for you or include usage examples in Postman?
```
