function emailFetch(populate, remove) {
    const sendMail = document.querySelector('.add__insp');
    sendMail.addEventListener('click', () => {
        let email = document.querySelectorAll('.eval__email')[0].value;
        if (email) {
            let toAddress = email,
                fromAddress = 'evainaina@@gmail.com',
                subject = "testing out the email function",
                body = "Have you checked out my articles on thisWebsite.com?";
            function sendEmail(to, from, subject, body) {
                Email.send({
                    Host: "smtp.gmail.com",
                    Username: "sender@email_address.com",
                    Password: "Enter your password",
                    To: to,
                    From: from,
                    Subject: subject,
                    Body: body,
                })
                    .then(function (message) {
                        alert("mail sent successfully")
                    });
            }

            sendEmail(toAddress, fromAddress, subject, body);
        }
    });

}