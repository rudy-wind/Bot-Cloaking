# PHP Cloaking Script


This project is a simple **cloaking mechanism** written in PHP.  
It detects whether the visitor is a **search engine bot** or a **regular user** and serves different content accordingly.  

⚠️ **Disclaimer:** This code is provided for educational purposes only.  
Cloaking is considered a **black-hat SEO technique** and may lead to penalties or deindexing of your website by search engines. Use it at your own risk.

---

## 📌 Features

- Detects popular search engine crawlers (Googlebot, Bingbot, Yandex, etc.) via the `User-Agent`.
- Optional detection of Google referrals via the `HTTP_REFERER` header.
- Serves different HTML files depending on visitor type:
  - `index.php` → shown to search engine bots.
  - `index-backup.php` → shown to normal visitors.
- Simple, lightweight, and no external dependencies.

---

## 📂 Project Structure

```
/your-project-folder
│── index.html              # Landing page (for bots)
│── index-backup.html       # Backup page (for users)
│── cloak.php               # Main cloaking script
````


## ⚙️ Installation

1. Make sure you have **PHP 7.4+** installed.
   ```bash
   php -v
   ````

2. Place the script (`cloak.php`) and your HTML files (`index.php` and `index-backup.php`) in the same directory.

3. Configure your web server (Apache/Nginx) to serve `cloak.php` as the main entry point.
   For example, rename it to `index.php` or update your virtual host configuration.



## 🚀 Usage

1. **For bots (Google, Bing, etc.)**
   When a search engine bot visits the root path `/`, it will see:

   ```html
   index.php
   ```

2. **For human visitors**
   Normal users will see:

   ```html
   index-backup.php
   ```

---

## 🛠️ Functions Explained

### `detectSearchEngineBot()`

Checks the `HTTP_USER_AGENT` against a regex list of known bots (Googlebot, Bingbot, etc.).
Returns `true` if the visitor is a search engine bot.

### `checkReferralFromGoogle()`

Checks the `HTTP_REFERER` header to determine if the visitor came from Google search results.
*(Currently not used in the main logic, but useful for custom rules.)*

### `loadLocalFileContent($filePath)`

Loads the content of a local file and returns it.
If the file does not exist, returns an error message.

---

## 🧩 Example Code Flow

```php
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (detectSearchEngineBot() && ($requestPath === '/' || $requestPath === '' || $requestPath === '/index.php')) {
    // Show landing page to bots
    echo loadLocalFileContent(__DIR__ . '/index.php');
} else {
    // Show backup page to human users
    eval('?>'.loadLocalFileContent(__DIR__ . '/index-backup.php'));
}
```

---

## ⚠️ Important Notes

* Using `eval()` may introduce **security risks** if you load untrusted files.
  Only use it with controlled, local files.
* Search engines may penalize cloaking, so use responsibly.
* You can extend the bot list in `detectSearchEngineBot()` if needed.

---

## 📜 License

This project is licensed under the **MIT License**.
You are free to use, modify, and distribute it at your own risk.
