/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package AllenamentoVinoUDPServer;

import java.io.IOException;
import java.net.DatagramPacket;
import java.net.DatagramSocket;
import java.net.InetAddress;
import java.net.SocketException;
import java.net.UnknownHostException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author INTEL
 */
public class Server {

    private DatagramSocket socket;
    private InetAddress indirizzo;
    private int porta;
    private byte[] bufferIN, bufferOUT;
    private ArrayList<String> comandi;
    private Map<String,String> memoria;

    public Server(int porta, String ip) {
        memoria=new HashMap<>();
        comandi = new ArrayList<>();
        comandi.add("I");
        comandi.add("A");
        comandi.add("P");

        try {
            this.porta = porta;

            socket = new DatagramSocket();
            indirizzo = InetAddress.getByName(ip);
        } catch (SocketException ex) {
            System.out.println(ex.getMessage());
        } catch (UnknownHostException ex) {
            Logger.getLogger(Server.class.getName()).log(Level.SEVERE, null, ex);
        }

        bufferIN = new byte[1024];
        bufferOUT = new byte[1024];
    }

    public void comunica() {
        boolean fine = false;
        String messaggio = "", ricevuto = "";
        DatagramPacket entrata, uscita;
        while (!fine) {
            try {
                entrata = new DatagramPacket(bufferIN, bufferIN.length);
                socket.receive(entrata);
                ricevuto = new String(entrata.getData());
                ricevuto = ricevuto.substring(0, entrata.getLength());
                System.out.println("DAL CLIENT: " + ricevuto);
                String[] split = ricevuto.split("#");

                if (comandi.contains(split[0])) {
                    switch (ricevuto) {
                        case "1":
                          
                    }
                }

            } catch (IOException ex) {
                System.out.println(ex.getMessage());
            }
        }
    }

}
