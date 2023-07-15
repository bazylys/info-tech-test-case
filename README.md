## Dev deploy

```bash
# Clone repo
git clone https://github.com/bazylys/info-tech-test-case

# Go to folder
cd info-tech-test-case

# Configure settings file
cp .env.example .env
nano .env

# Install dependencies
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
    
# Start docker 
vendor/bin/sail up

## [Swap to new term] ##

# Install dependencies
vendor/bin/sail npm install

# Build Front
vendor/bin/sail npm run dev
  
# Migrate db & generate key
vendor/bin/sail artisan key:generate
vendor/bin/sail artisan migrate
```

