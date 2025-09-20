# HealthChecker

<p align="center">
    <img width="100" src="https://github.com/Nerumir/healthchecker/blob/main/src/logo.png">
</p>

This minimalist PHP application is for monitoring your different services and applications in your IT infrastructure. There's a web portal accessed by authentification. You'll be able to register any service you wish to monitor. You can configure SMTP settings in order to recieve a mail every hour in case there's at least one of your registered services that is down. Everything is easily editable if you're familiar with programming. Feel free to edit the Dockerfile and the PHP files.

> [!TIP]
> You can use this PHP application as you want but the only installation guide in created is for a docker deployment. As it is a basic PHP application without any complex dependencies, any other deployments will be (I hope) easy for you anyways.

## Preview

<p align="center">
    <img width="100" src="https://github.com/Nerumir/healthchecker/blob/main/preview/main.png">
    <p style="text-align: center;color: #c6c6c6">Web portal</p>
</p>

<p align="center">
    <img width="100" src="https://github.com/Nerumir/healthchecker/blob/main/preview/smtp.png">
    <p style="text-align: center;color: #c6c6c6">SMTP settings to configure mail notifications.</p>
</p>

<p align="center">
    <img width="100" src="https://github.com/Nerumir/healthchecker/blob/main/preview/mail.png">
    <p style="text-align: center;color: #c6c6c6">Mail notification when at least one service is down.</p>
</p>

## Installation

You obviously need docker installed to follow this installation guide. I'll consider everything is setup properly. Feel free to follow the docker installation guide online if you don't have it.

> [!WARNING]
> You should change the `user` and `password` defined in the `src/auth.php` file before building the docker image !

To build and deploy the image sucessfully, you first need to clone the repository. Here's all the installation process (debian/ubuntu) :

```bash
sudo apt update
sudo apt install git
git clone https://github.com/Nerumir/healthchecker.git
cd healthchecker
# BEFORE BUILDING, CHANGE THE USERNAME AND PASSWORD IN src/auth.php !!!!
docker build . -t healthchecker
docker run -d -p 8080:80 --name my-container healthchecker
```

You now can access the web portal on the host's opened port 8080. If you deployed it on your local PC, just try going to http://localhost:8080. If you deployed it on a server, i'll consider you known how to access it in your own infrastructure. Note that there is no SSL version of this application. If you want to use it in production, i'll strongly advise the use of a reverse proxy with some certificate management.
