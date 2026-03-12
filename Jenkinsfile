node {
    checkout scm
    stage("Build"){
        docker.image('composer:2.6').inside('-u root') {
            sh 'rm -f composer.lock'
            sh 'composer install'
        }
    }
    docker.image('ubuntu').inside('-u root') {
        sh 'echo "Ini adalah test"'
    }
}

