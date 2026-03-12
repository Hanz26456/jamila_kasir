node {
    checkout scm
    stage("Build"){
        docker.image('composer:2.6').inside('-u root') {
            sh 'rm -f composer.lock'
            sh 'composer install'
        }
    }
    stage("Testing"){
        docker.image('ubuntu').inside('-u root') {
            sh 'echo "Ini adalah test"'
        }
    }
    stage("Deploy"){
    sshagent(['prod-server']) {
        sh '''
            ssh -o StrictHostKeyChecking=no farhan_maulana@172.23.0.1 "
                cd /var/jenkins_home/172.23.0.1 &&
                echo 'Deploy berhasil!'
            "
        '''
    }
}
}
